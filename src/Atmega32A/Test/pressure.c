#define __USE_C99_MATH

#include <stdbool.h>
#include <stdint.h>
#include <avr/io.h>
#include <util/delay.h>
#include "pressure.h"

void P_init(uint8_t gain)
{
    P_SCK_SET_OUTPUT;
    DT_SET_INPUT;

    P_set_gain(gain);
}

int P_is_ready(void)
{
    return (DT_INPUT & (1 << DT_PIN )) == 0;
}

void P_set_gain(uint8_t gain)
{
	switch (gain)
	{
		case 128:		// channel A, gain factor 128
			PGAIN = 1;
			break;
		case 64:		// channel A, gain factor 64
			PGAIN = 3;
			break;
		case 32:		// channel B, gain factor 32
			PGAIN = 2;
			break;
	}

	P_SCK_SET_LOW;
	P_read();
}

uint32_t P_read(void)
{
	// wait for the chip to become ready
	while (!P_is_ready());

    unsigned long count; 
    unsigned char i;
 
    DT_SET_HIGH;
    
    _delay_us(1);
 
    P_SCK_SET_LOW;
    _delay_us(1);
 
    count=0; 
    while(DT_READ); 
    for(i=0;i<24;i++)
    { 
        P_SCK_SET_HIGH; 
        _delay_us(1);
        count=count<<1; 
        P_SCK_SET_LOW; 
        _delay_us(1);
        if(DT_READ)
            count++; 
    } 
    count = count>>6;
    P_SCK_SET_HIGH; 
    _delay_us(1);
    P_SCK_SET_LOW; 
    _delay_us(1);
    count ^= 0x800000;
    return(count);
}

uint32_t P_read_average(uint8_t times)
{
	uint32_t sum = 0;
	for (uint8_t i = 0; i < times; i++)
	{
		sum += P_read();
		// TODO: See if yield will work | yield();
	}
	return sum / times;
}

double P_get_value(uint8_t times)
{
	return P_read_average(times) - POFFSET;
}

float P_get_units(uint8_t times)
{
	return P_get_value(times) / PSCALE;
}

void P_tare(uint8_t times)
{
	double sum = P_read_average(times);
	P_set_offset(sum);
}

void P_set_scale(float scale)
{
	PSCALE = scale;
}

float P_get_scale(void)
{
	return PSCALE;
}

void P_set_offset(double offset)
{
    POFFSET = offset;
}

double P_get_offset(void)
{
	return POFFSET;
}

void P_power_down(void)
{
	P_SCK_SET_LOW;
	P_SCK_SET_HIGH;
	_delay_us(70);
}

void P_power_up(void)
{
	P_SCK_SET_LOW;
}

uint8_t PshiftIn(void)
{
    uint8_t value = 0;

    for (uint8_t i = 0; i < 8; ++i)
    {
        P_SCK_SET_HIGH;
        value |= DT_READ << (7 - i);
        P_SCK_SET_LOW;
    }
    return value;
}
