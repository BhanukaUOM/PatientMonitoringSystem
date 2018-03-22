#define F_CPU 1000000UL

#include <avr/io.h>
#include <util/delay.h>
#include <avr/interrupt.h>
#include <stdlib.h>

//LCD
#define LCD_DDR DDRC
#define LCD_PORT PORTC
#define LCD_E PIND7
#define LCD_RS PIND6

//Keypad
#define KEYPAD_PORT PORTB
#define KEYPAD_DDR 	DDRB
#define KEYPAD_PIN 	PINB

//Selonoid
#define SELONOID_PORT PORTD
#define SELONOID_PIN PIND2

//AIRPUMP
#define AIRPUMP_PORT PORTD
#define AIRPUMP_PIN PIND3

//Body Temperature
#define TEMPR_PORT PORTA
#define TEMPR_PIN 0x01

//Respiration
#define RESP_PORT PORTA
#define RESP_PIN 0x00

//Buzzer
#define BUZZER_PORT PORTD
#define BUZZER_PIN PIND6

#include "LCD.h"
#include "bootScn.h"
#include "GSM.h"
#include "HX711.h"
#include "keypad.h"
#include "pressure.h"
 
double weight_value; //hx711 output value
char a[7];
int age;
int key;
char temprature[5];
int tno;
char tel[10];

int saline, sys, dia, heart, resp;
double tempr;

int main();

int saline_get(){
	HX711_init(128);
	HX711_set_scale(1.f);//242300.88
	HX711_set_gain(128);
	HX711_tare(10);
	weight_value =  (HX711_get_offset()-8389010.00)/160.00; //get percentage by 600g
	
	if(weight_value<100.00)
		return (int)weight_value;
	else
		return 100;
}

double temp_get(){
	int count = 0;
	int total = 0;
	uint8_t theLowADC;
	uint16_t res;
	
	for(int i=0; i<10; i++){
		ADCSRA |= 1<<ADPS1;
		ADMUX |= (1<<REFS0);			//set voltage to 5v Reference selection
		ADCSRA |= 1<<ADEN;				//enable analog to digital conversion
		ADMUX = TEMPR_PIN;
		
		ADCSRA |= 1<<ADSC;   //ADC Start Conversion
		_delay_ms(100);
		
		theLowADC = ADCL;
		res = ADCH<<8 | theLowADC;  //Get Analog to Digital data on A0 pin
		total += (5.0/9.0 * ((res/10.0)+25.0)+32.0);
		count++;
		_delay_ms(200);
	}
	
	return total/count;
}

int resp_get(){	
	uint8_t theLowADC;
	uint16_t res;
	int count = 0;
	int prev = 2000;
	
	TCCR1B |= 1<<CS10 | 1<<CS12; //counter1 with 1024 prescaler
	TCNT1 = 0;
	int timer_count = 0;
	
	while(timer_count >= 9759){  //loop  for 10s
		ADCSRA |= 1<<ADPS1;
		ADMUX |= (1<<REFS0);			//set voltage to 5v Reference selection
		ADCSRA |= 1<<ADEN;				//enable analog to digital conversion
		ADMUX = RESP_PIN;
	
		ADCSRA |= 1<<ADSC;   //ADC Start Conversion
		_delay_ms(100);
		timer_count += 97; //Add 100ms delay to timer counter
	
		theLowADC = ADCL;
		res = ADCH<<8 | theLowADC;		
		
		if((prev < res) && TCNT1 >= 3000){
			prev = res;
			count++;
			timer_count += TCNT1;
			TCNT1 = 0;
		}
		
	}
	return count * 6;
}

void getAge(){	//Get Patient's age from keypad
	lcd_clear();
	lcd_prints("Enter Age: ");
	lcd_goto(2,1);
	key = keypad_geti();
	if(key<10){
		age = key;
		lcd_printi(age, 1);
	}
	key = keypad_geti();
	if(key<10){
		age = age*10 + key;
		lcd_printi(key, 1);
		_delay_ms(1000);
	}
	else if(key==12){
		getAge();
	}
	else if(key==15){
		main();
	}
}

void getNo(){	//Get Doctors's Tel No from keypad
	lcd_clear();
	lcd_prints("Enter Tel No: ");
	lcd_goto(2,1);
	lcd_prints("0");
	tel[0] = '0';
	int i=0;
	while(i<9){
		char key = keypad_getc();
		while(key=='A' || key=='B'){
			key = keypad_getc();
		}
		if(key == 'C')
		getNo();
		lcd_printc(key);
		tel[i+1] = key;
		i++;
	}
	_delay_ms(1000);
}

void Solenoid_on(){
	SELONOID_PORT |= (1<<SELONOID_PIN);
}

void Solenoid_off(){
	SELONOID_PORT &= ~(1<<SELONOID_PIN);
}

void airpump_on(){
	AIRPUMP_PORT |= (1<<AIRPUMP_PIN);
}

void airpump_off(){
	AIRPUMP_PORT &= ~(1<<AIRPUMP_PIN);
}

void buzzer_on(){
	BUZZER_PORT |= (1<<BUZZER_PIN);
}

void buzzer_off(){
	BUZZER_PORT &= ~(1<<BUZZER_PIN);
}

void lcd_update(int sys, int dia, int pulse, double temp, int resp){
	lcd_clear();
	lcd_prints("Pres: ");
	lcd_printi(sys, 3);
	lcd_printc('/');
	lcd_printi(dia, 2);
	lcd_prints("mmHg");
	lcd_goto(2,1);
	lcd_prints("Pulse: ");
	lcd_printi(pulse, 3);
	lcd_goto(3,1);
	lcd_prints("Temp: ");
	lcd_printf(temp);
	lcd_printc(0b11011111);
	lcd_prints("F");
	lcd_goto(4,1);
	lcd_prints("Respiration: ");
	lcd_printi(resp, 2);
}

double pressure_get(){
	P_init(128);
	P_set_scale(1.f);//242300.88
	P_set_gain(128);
	P_tare(10);
	return (P_get_offset()-8422643.00)/1000;
}

void pressure_update(){
	TCCR0 |= 1 << CS00 | 1<<CS02;	// counter0 1024 prescaler
	TCCR1B |= 1<<CS10 | 1<<CS12; //counter1 with 1024 prescaler
	
	Solenoid_on();
	airpump_on();
	
	lcd_goto(3,1);
	lcd_prints("Air Pumping..");
	TCNT1 = 0;
	
	int hand_cuff_check = 0;
	
	while(TCNT1 >= 3000){
		_delay_ms(100);
		if(pressure_get() > 120.0){
			hand_cuff_check = 1;
		}
	}
	
	if (hand_cuff_check == 0){
		lcd_clear();
		lcd_prints("Measuring Pressure Failed..");
		airpump_off();
		Solenoid_off();
		dia = 0;
		sys = 0;
		heart = 0;		
		_delay_ms(2000);
	} else {
		lcd_clear();
		lcd_prints("Measuring Blood Pressure..");
		while(pressure_get() < 190.00);
		airpump_off();
		
		int count = 0;
		int timer_count = 0;
		double prev = 9999.9;
		double now;
		
		TCNT1 = 0;
		
		while(timer_count >= 9759){  //loop  for 10s
			if(TCNT1 > 600){
				timer_count += TCNT1;
				TCNT1 = 0;
			}
			now = pressure_get();
			if((prev < now) && TCNT1 >= 325){
				if(count == 0){
					sys = (int)now;
				}
				prev = now;
				count++;
				timer_count += TCNT1;
				TCNT1 = 0;
				dia = (int)now;
			}
			prev = now;
			
		}		
		Solenoid_off();
		heart = count * 6;
	}
}

int main(){	
	lcd_init();		//Initialize LCD Display
	lcd_boot();		//Startup Screen
	gsm_init(25);	//Initialize GSM with 9600 Baud
	_delay_ms(1000);
	getAge();
	gprs_init();
	getNo();
	itoa(tno,tel,10);
	
	DDRD |= (1<<SELONOID_PIN) | (1<<AIRPUMP_PIN) | (1<<BUZZER_PIN);	//Solenoid valve & Air Pump pins as output
	
	jump:
	while(1){
		int r=0, b=0, t=0, p=0;
		
		lcd_clear();
		lcd_prints("Measuring Temprature..");
		_delay_ms(1000);
		tempr = temp_get();
		lcd_update(0, 0, 0, tempr, 0);
		if((age>=0 && age<=10 && (tempr < 97.9 || tempr > 100.4)) || (age>=11 && age<=65 && (tempr < 98.6 || tempr > 100.6)) || (age>65 && (tempr < 97.1 || tempr > 99.2))){
			buzzer_on();
			gsm_send_sms(tel, "D001: Body Temprature is Abnormal");
			t=1;
		}
		_delay_ms(2000);
		
		lcd_clear();
		lcd_prints("Measuring Respiration Rate..");
		resp = resp_get();
		lcd_update(0, 0, 0, tempr, resp);
		if ((age<=1 && (resp<30 || resp >40)) || (age==2 && (resp<25 || resp >35)) || (age>=3 && age<=5 && (resp<25 || resp >30)) || (age>=6 && age<=12 && (resp<20 || resp >25)) || (age>=13 && (resp<12 || resp >20))) {
			buzzer_on();
			gsm_send_sms(tel, "D001: Respiration rate is abnormal");
			r=1;
		}
		_delay_ms(2000);
	
		lcd_clear();
		lcd_prints("Measuring Saline Level..");
		saline = saline_get();
		lcd_clear();
		lcd_prints("Saline LVL: ");
		lcd_printi(saline, 3);
		lcd_printc('%');
		if(saline < 10){
			buzzer_on();
			gsm_send_sms(tel, "D001: Saline Level lower than 10%");
		}
		_delay_ms(2000);
	
		lcd_clear();
		lcd_prints("Measuring Blood Pressure..");
		pressure_update();
		lcd_update(sys, dia, heart, tempr, resp);
	
		if(sys>120 && dia<80){
			b=1;
			buzzer_on();
			gsm_send_sms(tel, "D001: Blood Pressure is Abnormal");
		}
		if(heart>100 && heart<55){
			p=1;
			buzzer_on();
			gsm_send_sms(tel, "D001: Pulse Rate is Abnormal");
		}
		
		gprs_send_data(heart, dia, sys, saline, resp, tempr); //update data on server
		
		for(int i=0; i<100; i++){
			_delay_ms(200);
			if(k_g() == 10){
				lcd_clear();
				lcd_prints("Pressure: ");
				if(b==0){
					lcd_prints("Normal");
				} else {
					lcd_prints("Abnorm");
				}
				lcd_goto(2,1);
				lcd_prints("Pulse:  ");
				if(p==0){
					lcd_prints("Normal");
				} else {
					lcd_prints("Abnormal");
				}
				lcd_goto(3,1);
				lcd_prints("Temp:   ");
				if(t==0){
					lcd_prints("Normal");
				} else {
					lcd_prints("Abnormal");
				}
				lcd_goto(4,1);
				lcd_prints("Respirat: ");
				if(r==0){
					lcd_prints("Normal");
				} else {
					lcd_prints("Abnorm");
				}
				_delay_ms(3000);
				lcd_update(sys, dia, heart, tempr, resp);
			}
			if(k_g() == 11){
				lcd_clear();
				lcd_prints("Saline LVL: ");
				lcd_printi(saline, 3);
				lcd_printc('%');
				_delay_ms(3000);
				lcd_update(sys, dia, heart, tempr, resp);
			}
			if(k_g() == 12){
				goto jump;
			}
		}
	}
}