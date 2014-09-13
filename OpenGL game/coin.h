

#include "SDL/SDL.h"
#include "SDL/SDL_image.h"
#include "SDL/SDL_ttf.h"
#include "SDL/SDL_mixer.h"
#include <string>



int NUM_COIN=150;
float *COIN_ARR;
float error = 0.6;//must be greater than coin_size= (0.5)
static GLuint texName3;

bool playcoinmusic(Mix_Chunk *COIN_S)
{
if( Mix_PlayChannel( -1, COIN_S, 0 ) == -1 )
return 1;          
}

void COIN_INIT(int minX,int maxX,int minZ,int maxZ){
	int gap = 12;
	int HALF_SIDE1 = 2;
	
	COIN_ARR=new float[2*NUM_COIN];
	float x,y,z;
	for(int i=0;i<NUM_COIN;i++)
	{
		x = (rand()*1.0)/RAND_MAX;
		x=(maxX-minX)*x+minX;
		int qx = x/gap;
		while((x>=(gap*(qx+1)-2*HALF_SIDE1-error))&&(x<=gap*(qx+1)+error))
			{x = (rand()*1.0)/RAND_MAX;x=(maxX-minX)*x+minX;
		qx = x/gap;}
		z = (rand()*1.0)/RAND_MAX;
		z=(maxZ-minZ)*z+minZ;
		int qz = -z/gap;
		while((-z>=(gap*(qz+1)-2*HALF_SIDE1-error))&&(-z<=gap*(qz+1)+error))
			{z = (rand()*1.0)/RAND_MAX;z=(maxZ-minZ)*z+minZ;qz = -z/gap;}
		COIN_ARR[2*i]=x;
		COIN_ARR[2*i+1]=z;
		//cout<<x<<endl;
	}
}

float e=2;

int  r = 0;
static int score=0;




void drawcoin(float *ARR,float y,float size,double &camX,double &camY,double &camZ,Mix_Chunk *COIN_S){
	glColor3f(0,0,1);
	for(int i=0;i<NUM_COIN;i++)
			{
		if(fabs(camY-y) <= e/2 && fabs(camX-ARR[2*i])<=e && fabs(camZ-ARR[2*i+1])<=e){
			ARR[2*i] = -1;
			ARR[2*i+1] = 1;
			playcoinmusic(COIN_S);
			score+=1;

		
		}
		glPushMatrix();
		glTranslatef(ARR[2*i],y,ARR[2*i+1]);
		glRotatef(r,0,1,0);
		glTranslatef(-ARR[2*i],-y,-ARR[2*i+1]);		
		
		
		if(ARR[2*i] != -1){
			glEnable(GL_TEXTURE_2D);
   			glTexEnvf(GL_TEXTURE_ENV, GL_TEXTURE_ENV_MODE, GL_DECAL);
 			glBindTexture(GL_TEXTURE_2D, texName3);
			glBegin(GL_QUADS);
			glVertex3f(ARR[2*i]+size, y, ARR[2*i+1]);glTexCoord2f(0.0, 0.0);
			glVertex3f(ARR[2*i], y+size, ARR[2*i+1]);glTexCoord2f(0.0, 1.0);
			glVertex3f(ARR[2*i]-size, y, ARR[2*i+1]);glTexCoord2f(1.0, 1.0);		
			glVertex3f(ARR[2*i], y-size, ARR[2*i+1]);glTexCoord2f(1.0, 0.0);
			glEnd();
			glDisable(GL_TEXTURE_2D);
		}
		glPopMatrix();
		}
r = (r+10)%360;
}
