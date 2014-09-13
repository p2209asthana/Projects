int NUM_STARS=1000;
float *STAR_ARR;

void SKY_INIT()
{
	STAR_ARR=new float[3*NUM_STARS];
	int minX,minY,minZ,maxX,maxY,maxZ;
	minX=-100;maxX=200;minY=-100;maxY=100;minZ=100;maxZ=-100;
	float x,y,z;
	for(int i=0;i<NUM_STARS;i++)
	{
		x=(rand()*1.0)/RAND_MAX;
		y=(rand()*1.0)/RAND_MAX;
		z=(rand()*1.0)/RAND_MAX;
		x=x*(maxX-minX)+minX;
		y=y*(maxY-minY)+minY;
		z=z*(maxZ-minZ)+minZ;
		STAR_ARR[3*i]=x;
		STAR_ARR[3*i+1]=y;
		STAR_ARR[3*i+2]=z;
	}
}
void drawsky(float*arr,int size)
{
	glColor4f(1,1,1,1);
	
	for(int i=0;i<size;i++)
	{	glBegin(GL_POINTS);
		glVertex3f(STAR_ARR[3*i],STAR_ARR[3*i+1],STAR_ARR[3*i+2]);	
		glEnd();	
	}
}

