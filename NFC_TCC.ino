// ---------------------------------------Bibliotecas------------------------------------------------------------------------------------------------------------------------------------//
#include <SPI.h>
#include <MFRC522.h> //Biblioteca do sensor Rfid
#include <ESP8266WebServer.h>//Bibliotecas do Arduino nodemcu
#include <ESP8266HTTPClient.h>
//------------------------------------------------------Definicao das entradas-----------------------------------------------------------------------------------------------------------//
#define SS_PIN D2  //SDA/SS Esta conectado na entrada D2
#define RST_PIN D1  //RST Esta conectado na entrada D1
MFRC522 mfrc522(SS_PIN, RST_PIN);  //Cria uma instancia para o sensor MFRC522
#define ON_Board_LED 2  //Define o LED da placa que sera usado para mostrar a conexao com o Wifi

//----------------------------------------Nome e senha do Wi-fi--------------------------------------------------------------------------------------------------------------------------//
const char* ssid = "NET_2GEF758F";//Nome do Wifi
const char* password = "E2EF758F";//Senha do Wifi
ESP8266WebServer server(80);  //Servidor esta conectado na porta 80
//---------------------------------------Variaveis---------------------------------------------------------------------------------------------------------------------------------------//

int readsuccess;
byte readcard[4];
char str[32] = "";
String StrUID;

//-------------------------------------SETUP---------------------------------------------------------------------------------------------------------------------------------------------//
void setup() 
{
  Serial.begin(115200); //Inicia a comunicacao serial com o computador
  SPI.begin();      //Inicia o protocolo SPI
  mfrc522.PCD_Init(); //Inicia o sensor MFRC522

  delay(500);

  WiFi.begin(ssid, password); //Conecta a rede Wifi
  Serial.println("");
    
  pinMode(ON_Board_LED,OUTPUT); 
  digitalWrite(ON_Board_LED, HIGH); //Liga o LED da placa 
  // Para o led da placa nodemcu High =  led desligado e Low = led ligado

//----------------------------------------Conectando a rede Wifi-------------------------------------------------------------------------------------------------------------------------//
  Serial.print("Conectando");
  while (WiFi.status() != WL_CONNECTED) 
   {
      Serial.print(".");
      //----------------------------------------Faz o LED da placa ficar piscando enquanto esta conectando na rede Wifi------------------------------------------------------------------//
      digitalWrite(ON_Board_LED, HIGH);
      delay(250);
      digitalWrite(ON_Board_LED, LOW);
      delay(250);
   }
  digitalWrite(ON_Board_LED, HIGH); //Desliga o LED da placa quando conectar a rede Wifi
  //----------------------------------------Se a conexao com a rede Wifi for um sucesso--------------------------------------------------------------------------------------------------//
  Serial.println("");
  Serial.print("Conexao com o Wifi: ");
  Serial.println(ssid);
  Serial.println("foi um sucesso");
  
  Serial.print("Endereco de IP: ");
  Serial.println(WiFi.localIP());

  Serial.println("Aproxime o cartao do sensor para receber o UID");
  Serial.println("");
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//--------------------------------------------LOOP---------------------------------------------------------------------------------------------------------------------------------------//
void loop() 
{
  //Codigo principal que sera executado repetidas vezes

  //------------------------------------------------Leitura do cartao--------------------------------------------------------------------------------------------------------------------//
  readsuccess = getid();// Se a leitura do Cartao for um sucesso
 
  if(readsuccess) 
  {  
      digitalWrite(ON_Board_LED, LOW);
      HTTPClient http;    //Objeto declarado da classe HTTPClient
 
      String UIDresultSend, postData;//Variavel que ira mandar o uid da tag para o site
      
      UIDresultSend = StrUID;
      postData = "UIDresult=" + UIDresultSend;
  
      http.begin("http://192.168.0.10/NFC_Control/getUID.php");// Site para aonde enviara a informacao
      http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Tipo do cabecalho
      int httpCode = http.POST(postData);   //Envio solicitacao
      String payload = http.getString();    //Valida a solicitacao
  
      Serial.println(UIDresultSend);
      Serial.println(httpCode); 
      Serial.println(payload);    
    
     http.end();  //Fecha a conexao
      delay(1000);
     digitalWrite(ON_Board_LED, HIGH);
  }
}
int getid() {  
  if(!mfrc522.PICC_IsNewCardPresent()) //Se receber sinal do cartao
  {
    return 0;
  }
  if(!mfrc522.PICC_ReadCardSerial()) // Se ler o cartao
  {
    return 0;
  }
 
  
  Serial.print("O UID DO CARTAO E : ");
  
  for(int i=0;i<4;i++)
  {
    readcard[i]=mfrc522.uid.uidByte[i]; //Guarda a uid do cartao na variavel
    array_to_string(readcard, 4, str);
    StrUID = str;
  }
  mfrc522.PICC_HaltA();
  return 1;
}
void array_to_string(byte array[], unsigned int len, char buffer[]) 
{
    for (unsigned int i = 0; i < len; i++)
    {
        byte nib1 = (array[i] >> 4) & 0x0F;
        byte nib2 = (array[i] >> 0) & 0x0F;
        buffer[i*2+0] = nib1  < 0xA ? '0' + nib1  : 'A' + nib1  - 0xA;
        buffer[i*2+1] = nib2  < 0xA ? '0' + nib2  : 'A' + nib2  - 0xA;
    }
    buffer[len*2] = '\0';
}
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
