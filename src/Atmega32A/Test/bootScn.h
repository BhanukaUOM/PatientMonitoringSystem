void lcd_boot_prints(char *String)
{
	while(*String>0)
	{
		lcd_printc(*String);
		String++;
		_delay_ms(100);
	}
}

void lcd_boot(){
	lcd_clear();
	lcd_boot_prints(" REMOTE HEALTH    MONITORING         SYSTEM     GROUP-18 PROJECT");
	_delay_ms(1000);
	lcd_clear();
}