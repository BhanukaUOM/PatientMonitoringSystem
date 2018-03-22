#include <util/delay.h>

void gsm_init(int UBBR){
		UBRRH=UBBR<<8;
		UBRRL=UBBR;
		UCSRB|=(1<<RXEN)|(1<<TXEN);
		UCSRC|=(1<<URSEL)|(1<<UCSZ0)|(1<<UCSZ1);
}

void gsm_comm(char *a){
	
	while(*a>0)
	{
		while (!( UCSRA & (1<<UDRE)));
		UDR = *a++;
		_delay_ms(5);
	}
		
}

char gsm_get(){
	while(!(UCSRA & (1<<RXC))){
	}
	return UDR;
}

void gsm_send_sms(char *to, char *message){
	gsm_comm("AT\r");
	_delay_ms(500);

	gsm_comm("AT+CMGF=1\r");
	_delay_ms(500);

	gsm_comm("AT+CMGS=\"");
	gsm_comm(to);
	gsm_comm("\"\r");

	_delay_ms(500);
	gsm_comm(message);
	UDR = (26);
	_delay_ms(300);
}

void gprs_init(){
	gsm_comm("AT\r");
	_delay_ms(500);
	gsm_comm("AT+HTTPINIT\r");
	_delay_ms(500);
	gsm_comm("AT+SAPBR=3,1,\"APN\",\"ppwap\"\r");
	_delay_ms(500);
	gsm_comm("AT+SAPBR=1,1\r");
	_delay_ms(2000);
}

void gprs_close_conn(){
	gsm_comm("AT+HTTPTERM");
	UDR = ('\r');
	_delay_ms(1000);
}

void gprs_send_data(int HeartRate, int PressureDia, int PressureSys, int Saline, int Respiration, double Temp){
	char arr[3];
	char tmp[5];
	lcd_prints(arr);
	gsm_comm("AT+HTTPPARA=\"URL\",\"http://sallihoyamu.com/send.php?heart=");
	itoa(HeartRate, arr, 10);
	gsm_comm(arr);
	gsm_comm("&pr_dia=");
	itoa(PressureDia, arr, 10);
	gsm_comm(arr);
	gsm_comm("&pr_sys=");
	itoa(PressureSys, arr, 10);
	gsm_comm(arr);
	gsm_comm("&saline=");
	itoa(Saline, arr, 10);
	gsm_comm(arr);
	gsm_comm("&resp=");
	itoa(Respiration, arr, 10);
	gsm_comm(arr);
	gsm_comm("&temp=");
	dtostrf(Temp, 5, 2, tmp);
	gsm_comm(tmp);
	gsm_comm("\"\r");
	_delay_ms(500);
	gsm_comm("AT+HTTPPARA=\"CID\",1\r");
	_delay_ms(500);
	gsm_comm("AT+HTTPACTION=0\r");
}