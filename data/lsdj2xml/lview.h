/*
 *    lview - A .sav file viewer for LSDJ
 *    Author:         Georg Wiltschek
 *    Email:          georg.wiltschek AT gmail DOT com
 *    Version:        0.1 (23/03/09)
 *
 *	  Modified by: Josh Perez
 *	  Email:	josh AT goatslacker DOT com
 *
 *	  This program is free software: you can redistribute it and/or modify
 *	  it under the terms of the GNU General Public License as published by
 *	  the Free Software Foundation, either version 3 of the License, or
 *	  (at your option) any later version.
 *	              
 *	  This program is distributed in the hope that it will be useful,
 *	  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	  GNU General Public License for more details.
 *	                                                                                       
 *	  You should have received a copy of the GNU General Public License
 *	  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

void bailOut(char* szMessage);
void parseInstruments();

char *notes[] = {\
"---",\
"C-3","C#3","D-3","D#3","E-3","F-3","F#3","G-3","G#3","A-3","A#3","B-3",\
"C-4","C#4","D-4","D#4","E-4","F-4","F#4","G-4","G#4","A-4","A#4","B-4",\
"C-5","C#5","D-5","D#5","E-5","F-5","F#5","G-5","G#5","A-5","A#5","B-5",\
"C-6","C#6","D-6","D#6","E-6","F-6","F#6","G-6","G#6","A-6","A#6","B-6",\
"C-7","C#7","D-7","D#7","E-7","F-7","F#7","G-7","G#7","A-7","A#7","B-7",\
"C-8","C#8","D-8","D#8","E-8","F-8","F#8","G-8","G#8","A-8","A#8","B-8",\
"C-9","C#9","D-9","D#9","E-9","F-9","F#9","G-9","G#9","A-9","A#9","B-9",\
"C-A","C#A","D-A","D#A","E-A","F-A","F#A","G-A","G#A","A-A","A#A","B-A",\
"C-B","C#B","D-B","D#B","E-B","F-B","F#B","G-B","G#B","A-B","A#B","B-B",\
};

char *channel[] = {\
"PULSE","WAVE","KIT","NOISE"\
};

char *play[] = {\
"ONCE","LOOP","PINGPONG","MANUAL"\
};

char *wave[] = {\
"SAW","SQR","TRI"\
};

char *filter[] = {\
"LOW","HIGHP","BANDP","ALLP"\
};

char *dist[] = {\
"CLIP","WRAP","PINGPONG","MANUAL"\
};

char *phase[] = {\
"NORMAL","RESYNC","RESYN2"\
};

char *vibtype[] = {\
"HF","","SAW","","TRI","","SQR","","HF","","SAW","","TRI","","SQR"\
};

char commands[] = {\
'-','A','C','D','E','?','G','H','K','L','M','O','P','R','S','T','V','W','Z','-'\
};
