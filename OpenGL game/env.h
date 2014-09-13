#include<iostream>
#include<stdio.h>
#include<GL/glut.h>
#include<GL/gl.h>
#include<GL/glu.h>
#include"texture.cpp"
#include"block.h"
#include"sky.h"
#include"floor.h"
#include"boundary.h"
#include"ball.h"
#include"coin.h"


#include "SDL/SDL.h"
#include "SDL/SDL_image.h"
#include "SDL/SDL_ttf.h"
#include "SDL/SDL_mixer.h"
#include <string>

int base_lt, left_lt,front_lt,gap,top_lt,right_lt,back_lt,height;

Mix_Chunk *COIN_S,*GAMEOVER_S,*JUMP_S;
Mix_Music *BACKGROUND_S;
bool SOUND_INIT()
{
   //Initialize all SDL subsystems
    if( SDL_Init( SDL_INIT_EVERYTHING ) == -1 ){  return false; }
    if( Mix_OpenAudio( 22050, MIX_DEFAULT_FORMAT, 2, 4096 ) == -1 ){
        return false;}
	BACKGROUND_S = Mix_LoadMUS( "boss.wav" );
    COIN_S = Mix_LoadWAV( "coin.wav" );
    GAMEOVER_S= Mix_LoadWAV( "game_over.wav" );
    JUMP_S=Mix_LoadWAV( "jump.wav" );
}


bool playbackgroundmusic()
{
Mix_PlayMusic( BACKGROUND_S, -1 ) ;       
}
void envInitialize()
{
	NUM_ROWS=6;
	NUM_COLOUMNS=6;
	SKY_INIT();
	BLOCKS_INIT();
	base_lt=0; left_lt=0;gap=12;front_lt=0;
	right_lt=gap*NUM_ROWS-2*HALF_SIDE+gap;
	back_lt=-gap*NUM_COLOUMNS+2*HALF_SIDE-gap;
	height=6;
	COIN_INIT(left_lt+2,right_lt-2,front_lt-2,back_lt+2);
	load_bmp("dark.bmp",texName);
	load_bmp("grass3.bmp",texName1);
	load_bmp("wall3.bmp",texName2);
	load_bmp("gold.bmp",texName3);
	load_bmp("metal.bmp",texName4);
	load_bmp("cactus.bmp",texName5);


	SOUND_INIT();
	//playbackgroundmusic();
	
}

float coin_ht = 3.5;
float coin_sz = 0.5;


void drawmap(double& camX, double &camY,double&camZ)
{
	drawsky(STAR_ARR,NUM_STARS);
	drawfloor( left_lt,right_lt,front_lt,back_lt, base_lt);
	drawboundary( left_lt,right_lt,base_lt, base_lt+2*HALF_SIDE+height,   front_lt,back_lt);
	drawball( left_lt,right_lt,base_lt, base_lt+2*HALF_SIDE+height,   front_lt,back_lt,camX,camY,camZ,GAMEOVER_S);	
	drawcoin(COIN_ARR,coin_ht,coin_sz,camX,camY,camZ,COIN_S);
	for(int i=0;i<NUM_ROWS;i++)
	{
		for(int j=0;j<NUM_COLOUMNS;j++)
		{
			float centreX=gap*i-HALF_SIDE+ left_lt+gap;
			float centreY=HALF_SIDE+base_lt;
			float centreZ=-gap*j+HALF_SIDE+front_lt-gap;
			block a(centreX,centreY,centreZ);
			a.drawblock();
		}
	}
	
	glFlush();
}
