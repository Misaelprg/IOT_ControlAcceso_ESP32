#include <WiFi.h>
#include <HTTPClient.h>
#include <WebServer.h>

//#include <HardwareSerial.h>
//#include <Adafruit_Fingerprint.h>

//HardwareSerial mySerial(2);

//Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);

//String URL = "http://192.168.0.109/access_control_FCFM/test_echo.php";

const char* ssid = "AXTEL XTREMO-505C-2GHZ";
const char* password = "0362505C";

WebServer server(80);

void setup() {
  Serial.begin(115200);
  connectWiFi();

  // Ruta para recibir el ID del trabajador
  server.on("/register_id", HTTP_GET, handleRegisterId);
  server.begin();
  Serial.println("Servidor iniciado.");
}

void loop() {
  server.handleClient(); // Maneja las solicitudes del cliente
}

void connectWiFi() {
  WiFi.mode(WIFI_OFF);
  delay(1000);
  WiFi.mode(WIFI_STA);

  WiFi.begin(ssid, password);
  Serial.print("Connecting to Wifi: " + String(ssid));
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("\nConnected to: " + String(ssid));
  Serial.println("IP Address: " + WiFi.localIP().toString());

}

void handleRegisterId() {
    if (server.hasArg("worker_fid")) {
        String worker_fid = server.arg("worker_fid"); // Obtén el ID del trabajador
        Serial.println("ID del trabajador recibido: " + worker_fid);
        
        // Aquí puedes implementar cualquier lógica que necesites
        // por ejemplo, registrar la huella del trabajador o almacenarla

        // Respuesta al cliente
        server.send(200, "application/json", "{\"message\":\"ID recibido\", \"worker_fid\":\"" + worker_fid + "\"}");
    } else {
        server.send(400, "application/json", "{\"message\":\"ID de trabajador no proporcionado\"}");
    }
}
