/*
        XML2LSDJ - Converts XML data into an LSDJ Sav
        
	Author:		Josh Perez
	Email:		josh AT goatslacker DOT com
        
        This program is free software: you can redistribute it and/or modify
        it under the terms of the GNU General Public License as published by
        the Free Software Foundation, either version 3 of the License, or
        (at your option) any later version.
        
        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.
        
        You should have received a copy of the GNU General Public License
        along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

#include <stdio.h>
#include <stdlib.h>

void bailOut(char* szMessage);
void parseInstruments();
FILE *fr;
FILE *fp;

int main(int argc, char **args) {
/*
 *	  Program goals:
 *
 *	  read from file 1
 *	  convert char from file 1 into binary
 *	  overwrite file 2's sav structure data at the FSEEK point with file 1's data
 *	  save the file
 *
 *	  perhaps write into a temporary file ?
 *	  use blank lsdj sav structure by default ?
 */ 

       
        /* open .sav file */
        if ((fp = fopen(args[2], "w")) == NULL ||
			(fr = fopen(args[1], "r")) == NULL) {
                bailOut("Error opening .sav File\n");
        }
        
        /* DO IT */
        parseInstruments();
        
        /* close .sav file */
        if (fclose(fp) != 0 || fclose(fr) != 0) {
                bailOut("Couldn't close .sav File\n");
        }
        
        return 0;
}

void bailOut(char* szMessage) {
        printf("%s", szMessage);
        exit(0); // exit status false
}

void parseInstruments() {
        
        int i, j, pu_fine;
		int count = 0;
		char byte;
		char instr[16];
		char synth[16];
		char name[64];
		unsigned long int mask_envelope = 0x000000FF;
		unsigned long int mask_wave = 0x000000F0;
		unsigned long int mask_output = 0x0000000F;
		unsigned long int mask_table = 0x000000DF;
		unsigned long int mask_length = 0x0000007F;
		unsigned long int mask_synth = 0x000000F;

		char *buffer;
		int n;
        
        /* get the instrument data */
		/* fseek 3080 = SAV */
		/* fseek 995 = LSDSNG? */
		// 64 = total instruments
        fseek(fp, 0x3080, SEEK_SET);
        for(j=0; j<64; j++) {
		  //for(i=0; i<16; i++) {
			n = fread(buffer, 1, 16, fr);
			fwrite(buffer,1,n,fp);
		  //}
		}

/*
        fseek(fp, 0x3EB2, SEEK_SET);
        for(j=0; j<16; j++) {
		  for(i=0; i<16; i++) {
			fread(&synth[i],1,1,fp);
		  }
		}
*/

		exit(1); // exit status true
}
