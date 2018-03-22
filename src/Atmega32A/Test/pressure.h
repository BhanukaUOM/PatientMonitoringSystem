#ifndef pressure_h
#define pressure_h

    #define SCK_PORT         PORTA	                        // Power Down and Serial Clock Input Port
    #define SCK_DDR          DDRA                            // Power Down and Serial Clock DDR
    #define SCK_PIN          PA6                            // Power Down and Serial Clock Pin

    #define P_SCK_SET_OUTPUT   SCK_DDR |= (1<<SCK_PIN)

    #define P_SCK_SET_HIGH     SCK_PORT |= (1<<SCK_PIN)
    #define P_SCK_SET_LOW      SCK_PORT &= ~(1<<SCK_PIN)

    #define DT_PORT           PORTA                           // Serial Data Output Port
    #define DT_DDR            DDRA                            // Serial Data Output DDR
    #define DT_INPUT          PINA                            // Serial Data Output Input
    #define DT_PIN             PA5	                    // Serial Data Output Pin
    #define DT_READ           (DT_INPUT & (1<<DT_PIN ))    // Serial Data Output Read Pin

    #define DT_SET_HIGH       DT_PORT |= (1<<DT_PIN )
    #define DT_SET_LOW        DT_PORT &= ~(1<<DT_PIN )
    #define DT_SET_INPUT      DT_DDR &= ~(1<<DT_PIN ); DT_SET_HIGH
    #define DT_SET_OUTPUT     DT_DDR |= (1<<DT_PIN ); DT_SET_LOW

    uint8_t PGAIN;		                // amplification factor
    double POFFSET;	                // used for tare weight
    float PSCALE;	                    // used to return weight in grams, kg, ounces, whatever

	// define clock and data pin, channel, and gain factor
	// channel selection is made by passing the appropriate gain: 128 or 64 for channel A, 32 for channel B
	// gain: 128 or 64 for channel A; channel B works with 32 gain factor only
	void P_init(uint8_t gain);

	// check if P is ready
	// from the datasheet: When output data is not ready for retrieval, digital output pin DOUT is high. Serial clock
	// input PD_SCK should be low. When DOUT goes to low, it indicates data is ready for retrieval.
	int P_is_ready(void);

	// set the gain factor; takes effect only after a call to read()
	// channel A can be set for a 128 or 64 gain; channel B has a fixed 32 gain
	// depending on the parameter, the channel is also set to either A or B
	void P_set_gain(uint8_t gain);

	// waits for the chip to be ready and returns a reading
	uint32_t P_read(void);

	// returns an average reading; times = how many times to read
	uint32_t P_read_average(uint8_t times);

	// returns (read_average() - POFFSET), that is the current value without the tare weight; times = how many readings to do
	double P_get_value(uint8_t times);

	// returns get_value() divided by PSCALE, that is the raw value divided by a value obtained via calibration
	// times = how many readings to do
	float P_get_units(uint8_t times);

	// set the POFFSET value for tare weight; times = how many times to read the tare value
	void P_tare(uint8_t times);

	// set the PSCALE value; this value is used to convert the raw data to "human readable" data (measure units)
	void P_set_scale(float scale);

	// get the current PSCALE
	float P_get_scale(void);

	// set POFFSET, the value that's subtracted from the actual reading (tare weight)
	void P_set_offset(double offset);

	// get the current POFFSET
	double P_get_offset(void);

	// puts the chip into power down mode
	void P_power_down(void);

	// wakes up the chip after power down mode
	void P_power_up(void);

    // Sends/receives data. Modified from Arduino source
	uint8_t PshiftIn(void);

	unsigned long P_Read(void);

#endif /* pressure_h */
