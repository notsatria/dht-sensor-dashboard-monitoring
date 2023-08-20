#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ArduinoJson.h>
#include <WiFiClientSecure.h>
#include "DHT.h"

WiFiClientSecure wifiClient;

const char* ssid = "Apa";
const char* password = "12345678";

// Inisialisasi variable host
const char* server = "dahsboardkandangayam.online";

const int httpPort = 443;

#define dhtpin D5
#define dhttype DHT22

// Ganti pin LED menjadi pin relay
int pinRelay1 = D0;
int pinRelay2 = D1;
int pinRelay3 = D2;
int pinRelay4 = D3;
int pinRelay5 = D4;

#define ON LOW    // Relay aktif dengan tegangan rendah (LOW)
#define OFF HIGH  // Relay non-aktif dengan tegangan tinggi (HIGH)

DHT dht(dhtpin, dhttype);

bool isAutomaticMode = false;

void setup() {
  Serial.begin(115200);
  dht.begin();
  // Inisialisasi hostname ( NodeMCU )
  WiFi.hostname("Node MCU");
  Serial.print("Konek ke: ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  // --- End of Connect wifi

  // Deklarasi PIN Relay || NANTINYA AKAN DIGUNAKAN UNTUK FAN, COOLER, HEATER
  pinMode(pinRelay1, OUTPUT);
  pinMode(pinRelay2, OUTPUT);
  pinMode(pinRelay3, OUTPUT);
  pinMode(pinRelay4, OUTPUT);
  pinMode(pinRelay5, OUTPUT);
  // Set status awal relay menjadi OFF (non-aktif)
  digitalWrite(pinRelay1, OFF);
  digitalWrite(pinRelay2, OFF);
  digitalWrite(pinRelay3, OFF);
  digitalWrite(pinRelay4, OFF);
  digitalWrite(pinRelay5, OFF);
}

void loop() {
  int kelembapan = dht.readHumidity();
  float suhu = dht.readTemperature();

  // Tampilkan di serial monitor
  Serial.println("Suhu: " + String(suhu));
  Serial.println("Kelembapan: " + String(kelembapan));

  delay(5000);

  if (!wifiClient.connect(server, httpPort)) {
    Serial.println("Gagal terkoneksi ke web server");
    return;
  }

  HTTPClient http;
  Serial.print("[HTTP] begin...\n");
  //IP menuju ke server web
  String link = "https://" + String(server) + ":" + String(httpPort) + "/dashboard-monitoring/php/kirim-data-kandang.php?suhu=";
  link += String(suhu, 3);
  link += "&kelembapan=";
  link += String(kelembapan);
  Serial.printf("Link : %s\n", link.c_str());
  http.begin(wifiClient, link);

  Serial.print("[HTTP] GET...\n");
  int httpCode = http.GET();
  Serial.print(httpCode);

  String respon = http.getString();
  Serial.println(respon);

  if (httpCode > 0) {
    // HTTP header has been send and Server response header has been handled
    Serial.printf("[HTTP] GET... code: %d\n", httpCode);
    // file found at server
    //If(200 == 200)
    if (httpCode == HTTP_CODE_OK) {
      String answer = http.getString();
      //awal
      // Convert to JSON
      String jsonAnswer;
      int jsonIndex;

      for (int i = 0; i < answer.length(); i++) {
        if (answer[i] == '{') {
          jsonIndex = i;
          break;
        }
      }

      // Get JSON data
      jsonAnswer = answer.substring(jsonIndex);
      Serial.println();
      Serial.println("JSON answer: ");
      Serial.println(jsonAnswer);
      jsonAnswer.trim();

      // Allocate the JSON document
      // Use https://arduinojson.org/v6/assistant to compute the capacity.
      // const size_t capacity = JSON_OBJECT_SIZE(3) + JSON_ARRAY_SIZE(2) + 60;
      // DynamicJsonDocument doc(capacity);

      // Stream& input;
      StaticJsonDocument<192> doc;

      DeserializationError error = deserializeJson(doc, jsonAnswer);

      if (error) {
        Serial.print(F("deserializeJson() failed: "));
        Serial.println(error.f_str());
        return;
      }

      const char* id = doc["id"];
      const char* fan_1 = doc["fan_1"];
      const char* fan_2 = doc["fan_2"];
      const char* fan_3 = doc["fan_3"];
      const char* cooler = doc["cooler"];
      const char* heater = doc["heater"];
      const char* otomatis = doc["otomatis"];

      // Extract values
      Serial.println(F("Response:"));
      Serial.println(doc["id"].as<const char*>());
      Serial.println(doc["fan_1"].as<const char*>());
      Serial.println(doc["fan_2"].as<const char*>());
      Serial.println(doc["fan_3"].as<const char*>());
      Serial.println(doc["cooler"].as<const char*>());
      Serial.println(doc["heater"].as<const char*>());
      Serial.println(doc["otomatis"].as<const char*>());

      // Mengontrol Relay berdasarkan data dari server

      if (doc["otomatis"] == "1") {
        if (suhu > 28) {
          isAutomaticMode = true;
        } else {
          isAutomaticMode = false;
        }

      } else if (doc["otomatis"] == "0") {
        isAutomaticMode = false;
      }


      if (isAutomaticMode == true && suhu > 28) {

        digitalWrite(pinRelay1, ON);
        digitalWrite(pinRelay2, ON);
        digitalWrite(pinRelay3, ON);
        digitalWrite(pinRelay4, ON);

       
      } else if (isAutomaticMode == true && suhu < 28) {
        digitalWrite(pinRelay1, OFF);
        digitalWrite(pinRelay2, OFF);
        digitalWrite(pinRelay3, OFF);
        digitalWrite(pinRelay4, OFF);

       
      }

      if (isAutomaticMode == false) {
        if (doc["fan_1"] == "1") {
          digitalWrite(pinRelay1, ON);
        } else {
          digitalWrite(pinRelay1, OFF);
        }

        if (doc["fan_2"] == "1") {
          digitalWrite(pinRelay2, ON);
        } else {
          digitalWrite(pinRelay2, OFF);
        }

        if (doc["fan_3"] == "1") {
          digitalWrite(pinRelay3, ON);
        } else {
          digitalWrite(pinRelay3, OFF);
        }

        if (doc["cooler"] == "1") {
          digitalWrite(pinRelay4, ON);
        } else {
          digitalWrite(pinRelay4, OFF);
        }

        if (doc["heater"] == "1") {
          digitalWrite(pinRelay5, ON);
        } else {
          digitalWrite(pinRelay5, OFF);
        }
      } else {
        Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
      }
    }
  }
  http.end();
}
