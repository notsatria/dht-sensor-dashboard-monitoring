#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ArduinoJson.h>
#include "DHT.h"

WiFiClient wifiClient;

const char* ssid = "Playmedia";
const char* password = "ZTEGC1D7BBDF";

// Inisialisasi variable host
const char* server = "192.168.1.12";

const int httpPort = 8080;


#define dhtpin D5
#define dhttype DHT11
int pinLED1 = D0;
int pinLED2 = D1;
int pinLED3 = D2;
int pinLED4 = D3;
int pinLED5 = D4;
#define ON HIGH
#define OFF LOW

DHT dht (dhtpin, dhttype);

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

  // Deklarasi PIN LED || NANTINYA AKAN DIGUNAKAN UNTUK FAN, COOLER, HEATER
  pinMode(pinLED1, OUTPUT);
  pinMode(pinLED2, OUTPUT);
  pinMode(pinLED3, OUTPUT);
  pinMode(pinLED4, OUTPUT);
  pinMode(pinLED5, OUTPUT);
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
  String link = "http://" + String(server) + ":" + String(httpPort) + "/dashboard-monitoring/production/php/kirim-data-kandang.php?suhu=";
  link += String(suhu, 3);
  link += "&kelembapan=";
  link += String(kelembapan);
  Serial.printf("Link : %s\n", link.c_str());
  http.begin(link);


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

      // Extract values
      Serial.println(F("Response:"));
      Serial.println(doc["id"].as<const char*>());
      Serial.println(doc["fan_1"].as<const char*>());
      Serial.println(doc["fan_2"].as<const char*>());
      Serial.println(doc["fan_3"].as<const char*>());
      Serial.println(doc["cooler"].as<const char*>());
      Serial.println(doc["heater"].as<const char*>());


      if (doc["fan_1"] == "1") {
        digitalWrite(pinLED1, ON);
      } else {
        digitalWrite(pinLED1, OFF);
      }

      if (doc["fan_2"] == "1") {
        digitalWrite(pinLED2, ON);
      } else {
        digitalWrite(pinLED2, OFF);
      }

      if (doc["fan_3"] == "1") {
        digitalWrite(pinLED3, ON);
      } else {
        digitalWrite(pinLED3, OFF);
      }

      if (doc["cooler"] == "1") {
        digitalWrite(pinLED4, ON);
      } else {
        digitalWrite(pinLED4, OFF);
      }

      if (doc["heater"] == "1") {
        digitalWrite(pinLED5, ON);
      } else {
        digitalWrite(pinLED5, OFF);
      }

    } else {
      Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
    }
  }
  http.end();
}
