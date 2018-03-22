static int cur = 0;

void lcd_comm(int num){
	PORTD &= ~(1<<LCD_RS);
	LCD_PORT = num;
	PORTD |= 1<<LCD_E;
	_delay_ms(1);
	PORTD &= ~(1<<LCD_E);
	_delay_ms(1.52);
}

void lcd_init(){
	MCUCSR = 1<<JTD;
	MCUCSR = 1<<JTD;
	LCD_DDR = 0b11111111;
	DDRD |= (1<<LCD_E)|(1<<LCD_RS);
	_delay_ms(15);
	
	lcd_comm(0b00000001);
	lcd_comm(0b00111000);
	lcd_comm(0b00001100);
}

void sendc(char a){
	PORTD |= (1<<LCD_RS);
	_delay_us(100);
	LCD_PORT = a;
	PORTD |= 1<<LCD_E;
	_delay_ms(1);
	PORTD &= ~(1<<LCD_E);
	_delay_ms(1.5);
}

void lcd_printc(char a){
	if(cur==16){
		lcd_comm(0b11000000);
		sendc(a);
		cur++;
	}
	else if(cur==32){
		lcd_comm(0b10010000);
		sendc(a);
		cur++;
	}
	else if(cur==48){
		lcd_comm(0b11010000);
		sendc(a);
		cur++;
	}
	else if(cur==64){
		cur=0;
		lcd_comm(0b00000001);
		sendc(a);
		cur++;
	}
	else {
		sendc(a);
		cur++;
	}
	
}

void lcd_prints(char *String)
{
	while(*String>0)
	{
		lcd_printc(*String);
		String++;
	}
}

void lcd_clear(){
	lcd_comm(0b00000001);
	cur = 0;
}

void lcd_printi(int number, int maxLength){
	char arr[maxLength];
	itoa(number, arr, 10);
	lcd_prints(arr);
}

void lcd_goto(int row, int column){
	switch(row){
		case 1: lcd_comm(0b10000000 + column-1); cur = column-1; break;
		case 2: lcd_comm(0b11000000 + column-1); cur = 16 + column-1; break;
		case 3: lcd_comm(0b10010000 + column-1); cur = 32 + column-1; break;
		case 4: lcd_comm(0b11010000 + column-1); cur = 48 + column-1; break;
	}
}

void lcd_printf(double value){
	char res_str[5];
	dtostrf(value, 5, 2, res_str);
	lcd_prints(res_str);
}