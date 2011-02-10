/*
        LSDJ2XML - Converts Instrument data to XML
        
	Author:		Josh Perez
	Email:		josh AT goatslacker DOT com
  Mad Credits to: Georg Wiltschek
	Awesome program: lview
        
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
#include "lview.h"

FILE *fp;

int main(int argc, char **args) {
        
        /* open .sav file */
        if ((fp = fopen(args[1], "r")) == NULL) {
                bailOut("Error opening .sav File\n");
        }
        
        /* DO IT */
        parseInstruments();
        
        /* close .sav file */
        if (fclose(fp) != 0) {
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
		char *name[64][5];
		unsigned long int mask_envelope = 0x000000FF;
		unsigned long int mask_wave = 0x000000F0;
		unsigned long int mask_output = 0x0000000F;
		unsigned long int mask_table = 0x000000DF;
		unsigned long int mask_length = 0x0000007F;
		unsigned long int mask_synth = 0x000000F;


/*
    fseek(fp, 0x3A80, SEEK_SET);
    for(i=0; i<32; i++) {
      for (j=0; j<16; j++) {
  		  fread(&table_vol[j],1,1,fp);
  		  printf("%x", table_vol[j]);
      }
    }

    printf("\n\n");
*/

		/* get instrument names */
		fseek(fp, 0x1E7A, SEEK_SET);
		for(i=0; i<64; i++) {
		  fread(&name[i],1,5,fp);
		  // printf("%s\n", name[i]);
		}
        
        printf("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n");
		printf("<lsdj>\n");
        /* get the instrument data */
		/* fseek 3080 = SAV */
		/* fseek 995 = LSDSNG? */
		// 64 = total instruments
        fseek(fp, 0x3080, SEEK_SET);
        for(j=0; j<64; j++) {
    		  for(i=0; i<16; i++) {
      			fread(&instr[i],1,1,fp);
    			  //printf("%x ", instr[i]);
    		  }

		  /* if blank_instrument then, do nothing. */
		  if (instr[0] == 0 
		  && (instr[1] & mask_envelope) == 0xA8
		  && (instr[2] == 0)
		  && (~instr[3] & mask_length) == 0x7F
		  && (instr[4] & mask_envelope) == 0xFF
		  && instr[5] == 0
		  && (instr[6] & mask_table) == 0
		  && instr[7] == 3) {
			//break;
		  }

		  printf("\t<instrument value='%d'>\n", j);
		  if (name[j]) printf("\t\t<name>%s</name>\n", name[j]);
		  else printf("\t\t<name>%s%d</name>\n", channel[instr[0]]);
		  printf("\t\t<type>%s</type>\n", channel[instr[0]]);

		  if (instr[0] != 1) {
			// envelope
			printf("\t\t<envelope>%X</envelope>\n", (instr[1] & mask_envelope));
		  } else if (instr[0] == 1) {
			// volume
			printf("\t\t<volume>");
			switch ((instr[1] & mask_envelope)) {
			  case 0xA8:
				printf("3");
				break;
			  case 0x40:
				printf("2");
				break;
			  case 0x20:
				printf("1");
				break;
			  default:
				printf("0");
			}
			printf("</volume>\n");
		  }

		  if (instr[0] != 1) {
			// wave, output and pu fine:
			int wo = (instr[7] & mask_envelope); // wo = wave/output
			for(pu_fine=0; pu_fine<16; pu_fine++) {
				if (
				wo  < 0x04 ||
				(wo > 0x3F && wo < 0x44) ||
				(wo > 0x7F && wo < 0x84) ||
				(wo > 0xBF && wo < 0xC4)
				) {
				  break;
				}
				wo = wo - 4;
			}
			instr[7] = wo; // set the result back to instr[7] (wave+output)

			// wave
			if (instr[0] == 0) {
			  printf("\t\t<wave>");
			  switch ((instr[7] & mask_wave)) {
				case 0x40:
				  printf("25%%");
				  break;
				case 0x80:
				  printf("50%%");
				  break;
				case 0xC0:
				  printf("75%%");
				  break;
				default:
				  printf("12.5%%");
			  }
			  printf("</wave>\n");
			}
		}

		  // output
		  printf("\t\t<output>");
		  switch ((instr[7] & mask_output)) {
			case 0x01:
			  printf("L-");
			  break;
			case 0x02:
			  printf("-R");
			  break;
			case 0x03:
			  printf("LR");
			  break;
			default:
			  printf("--");
		  }
		  printf("</output>\n");

		  if (instr[0] != 1) {
			// length
			printf("\t\t<length>");
			switch ((~instr[3] & mask_length)) {
			  case 0x7F:
				printf("UNLIM");
				break;
			  default:
				printf("%X", (~instr[3] & mask_length));
			}
			printf("</length>\n");

			// sweep & shape
			printf("\t\t<sweep>%X</sweep>\n", (instr[4] & mask_envelope));

			if (instr[0] == 0) {
			  // vib type
			  printf("\t\t<vibtype>%s</vibtype>\n", vibtype[instr[5]]);
			  // pu2 tune
			  printf("\t\t<pu2tune>%X</pu2tune>\n", instr[2]);
			  // pu fine
			  printf("\t\t<pufine>%X</pufine>\n", pu_fine);
			}

		  } else if (instr[0] == 1) {
			// wave instrument
			// vib type
			printf("\t\t<vibtype>%s</vibtype>\n", vibtype[instr[5]]);
			// synth
			printf("\t\t<synth>%X</synth>\n", (instr[2] & mask_synth));
			// play
			printf("\t\t<play>%s</play>\n", play[instr[9]]);
			// length
			printf("\t\t<length>%X</length>\n", (instr[14] & mask_wave));
			// repeat
			printf("\t\t<repeat>%X</repeat>\n", (instr[2] & mask_output));
			// Speed
			printf("\t\t<speed>%X</speed>\n", (instr[14] & mask_output) + 1);
		  }

		  // automate
		  if (instr[5] > 6) printf("\t\t<automate>ON</automate>");
		  else printf("\t\t<automate>OFF</automate>");

		  // table
		  if (instr[6] != 0) printf("\n\t\t<table>%X</table>\n", (instr[6] & mask_table));
		  else printf("\n\t\t<table>OFF</table>\n");

		  printf("\t</instrument>\n");
        }

        fseek(fp, 0x3EB2, SEEK_SET);
        for(j=0; j<16; j++) {
		  for(i=0; i<16; i++) {
			fread(&synth[i],1,1,fp);
		  }

		  if (synth[0] == 0
		  && synth[1] == 0
		  && synth[2] == 0
		  && synth[3] == 0
		  && synth[4] == 0
		  && (synth[5] & mask_envelope) == 0x10
		  && (synth[6] & mask_envelope) == 0xFF
		  && synth[7] == 0
		  && synth[8] == 0
		  && (synth[9] & mask_envelope) == 0x10
		  && (synth[10] & mask_envelope) == 0xFF
		  && synth[11] == 0
		  && synth[12] == 0) {
			break;
		  }
		
		  printf("\t<synth value='%d'>\n", j);
		  printf("\t\t<wave>%s</wave>\n", wave[synth[0]]);
		  printf("\t\t<filter>%s</filter>\n", filter[synth[1]]);
		  printf("\t\t<q>%X</q>\n", synth[2]);
		  printf("\t\t<dist>%s</dist>\n", dist[synth[3]]);
		  printf("\t\t<phase>%s</phase>\n", phase[synth[4]]);
		  
		  printf("\t\t<start>\n");
		  printf("\t\t\t<volume>%X</volume>\n", (synth[5] & mask_envelope));
		  printf("\t\t\t<cutoff>%X</cutoff>\n", (synth[6] & mask_envelope));
		  printf("\t\t\t<phase>%X</phase>\n", synth[7]);
		  printf("\t\t\t<vshift>%X</vshift>\n", synth[8]);
		  printf("\t\t</start>\n");

		  printf("\t\t<end>\n");
		  printf("\t\t\t<volume>%X</volume>\n", (synth[9] & mask_envelope));
		  printf("\t\t\t<cutoff>%X</cutoff>\n", (synth[10] & mask_envelope));
		  printf("\t\t\t<phase>%X</phase>\n", synth[11]);
		  printf("\t\t\t<vshift>%X</vshift>\n", synth[12]);
		  printf("\t\t</end>\n");

		  printf("\t</synth>\n");
		}
		printf("</lsdj>");
		exit(1); // exit status true
}
