int keyArray[4][4] =	{{13, 12, 11, 10},
						 {15, 9, 6, 3},
						 {0, 8, 5, 2},
						 {14, 7, 4, 1}};

int k_g()
{
	uint8_t r,c;
	KEYPAD_DDR = 0b11110000;
	KEYPAD_PORT|= 0b00001111;

	for(c=0;c<4;c++)
	{
		KEYPAD_DDR&=~(0b01111111);

		KEYPAD_DDR|=(0b10000000>>c);
		for(r=0;r<4;r++)
		{
			if(!(KEYPAD_PIN & (0b00001000>>r)))
			{
				return keyArray[c][r];
			}
		}
	}

	return 0XFF; //Indicate No key pressed
}

int keypad_geti(){	
	_delay_ms(400);
	while(k_g()== 0xFF);
	return k_g();
}

char keypad_getc(){
	_delay_ms(400);
	while(k_g()== 0xFF);
	if (k_g() == 1)
		return '1';
	else if (k_g() == 2)
		return '2';
	else if (k_g() == 3)
		return '3';
	else if (k_g() == 4)
		return '4';
	else if (k_g() == 5)
		return '5';
	else if (k_g() == 6)
		return '6';
	else if (k_g() == 7)
		return '7';
	else if (k_g() == 8)
		return '8';
	else if (k_g() == 9)
		return '9';
	else if (k_g() == 0)
		return '0';
	else if (k_g() == 10)
		return 'A';
	else if (k_g() == 11)
		return 'B';
	else if (k_g() == 12)
		return 'C';
	else if (k_g() == 13)
		return 'D';
	else if (k_g() == 14)
		return '*';
	else
		return '#';
}