#include<iostream>
#include "SDL/SDL.h"
#include "SDL/SDL_image.h"
#include "SDL/SDL_ttf.h"
#include "SDL/SDL_mixer.h"
#include <string>
#include<unistd.h>
using namespace std;
#define HALF_SIDE 2


bool show_menu=1;
bool gameover=false;
static GLuint texName4,texName5;	
float inc = 0.3;
float posx[30] = {0,15,30,45,60,75,0,15,30,45,60,75,0,15,30,45,60,75,0,15,30,45,60,75,0,15,30,45,60,75};
float posz[30] = {3,16,28,40,52,64,3,16,28,40,52,64,3,16,28,40,52,64,3,16,28,40,52,64,3,16,28,40,52,64};
float cylradius = 0.8;
float cylrotate = 0;
float err = 0.8;
float er = 0.1;
int dir[30] = {0,1,0,1,1,1,0,0,1,0,1,0,1,0,0,0,1,1,0,1,0,0,0,0,1,1,0,0,1,0};//0 = x, 1 = -x, 2 = z , 3 = -z

bool playgameovermusic(Mix_Chunk *GAMEOVER_S)
{
if( Mix_PlayChannel( -1, GAMEOVER_S, 0 ) == -1 )
return 1;          
}


void drawball(float minX, float maxX,float minY,float maxY,float minZ,float maxZ,double &camX,double &camY,double &camZ,Mix_Chunk *GAMEOVER_S){
	int gap=12;
	int NUM_ROWS = 6;
	int NUM_COLS = 6;
	
	glColor3f(1,0,0);

	//left wall
	for(int i=0;i<3*NUM_ROWS;i++){
		
		GLUquadric *quadratic;
		quadratic = gluNewQuadric();
		glPushMatrix();
			glEnable(GL_TEXTURE_2D);
			glBindTexture(GL_TEXTURE_2D, texName4);
			;
			
			  //Bottom
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_NEAREST);
			glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_NEAREST);
			glTranslatef(posx[i],cylradius,-posz[i]);
			if(dir[i] == 0){				
				glRotatef(cylrotate,0,0,-1);
			}
			else if(dir[i] == 1){				
				glRotatef(cylrotate,0,0,1);
			}
			else if(dir[i] == 2){				
				glRotatef(cylrotate,-1,0,0);
			}
			else if(dir[i] == 3){				
				glRotatef(cylrotate,1,0,0);
			}
			cylrotate += inc*5;
			if(fabs(posx[i]-camX) <= err && fabs(-posz[i]-camZ) <= err && fabs(HALF_SIDE-camY) <= err){
				{
					gameover=true;

					
				}
			}
			gluQuadricTexture(quadratic,1);
			gluSphere(quadratic,cylradius,32,32);
		glPopMatrix();

		
	//}
	
	//increment the positions of the spheres
	//for(int i=0;i<2*NUM_ROWS;i++){
		int qx = posx[i]/gap;
		int qz = posz[i]/gap;
	//for(int i=0;i<5;i++){
			if(dir[i] == 0){
				posx[i] += inc;	
			}
			else if(dir[i] == 1){
				posx[i] -= inc;	
			}
			else if(dir[i] == 2){
				posz[i] += inc;	
			}
			else if(dir[i] == 3){
				posz[i] -= inc;	
			}
			//cout<<posx[i]<<" "<<((qx+0.5)*gap+HALF_SIDE)<<endl<<endl;
			//cout<<posz[i]<<" "<<((qz+0.5)*gap+HALF_SIDE)<<endl;
		
		if(fabs(posx[i]-((qx+0.5)*gap-HALF_SIDE))<= er && fabs(posz[i]-((qz+0.5)*gap-HALF_SIDE))<= er ){
			float tmp = (rand()*1.0)/RAND_MAX;
			if(tmp>=0 && tmp<0.25){
				dir[i] = 0;
			}
			else if(tmp>=0.25 && tmp<0.5){
				dir[i] = 1;
			}
			else if(tmp>=0.5 && tmp<0.75){
				dir[i] = 2;
			}
			else if(tmp>=0.75 && tmp<1){
				dir[i] = 3;
			}
		}
		if(posx[i] > maxX-cylradius){
			dir[i] = 1;
		}
		else if(posx[i] < minX+cylradius){
			dir[i] = 0;
		}
		else if(posz[i] > -maxZ-cylradius){
			dir[i] = 3;
		}
		if(posz[i] < -minZ+cylradius){
			dir[i] = 2;
		}
	}
	//}	
}
