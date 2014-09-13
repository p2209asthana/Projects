#include <GL/gl.h>
#include <GL/glu.h>
#include <GL/glut.h>
#include <fstream>
//#include "Texture.cpp"
#include <string.h>

using namespace std;



int load_bmp(string a,GLuint &texName)
{
	int width,height;
	unsigned char header[54]; // Each BMP file begins by a 54-bytes header
	unsigned int dataPos;     // Position in the file where the actual data begins
	unsigned int imageSize;   // = width*height*3
	// Actual RGB data
	unsigned char * data;
	// Open the file
	FILE * file = fopen(a.c_str(),"rb");
	if (!file)                              {printf("Image could not be opened\n"); return 0;}
	if ( fread(header, 1, 54, file)!=54 ){ // If not 54 bytes read : problem
    	printf("Not a correct BMP file\n");
    	return false;
	}
	if ( header[0]!='B' || header[1]!='M' )
	{
    printf("Not a correct BMP file\n");
    return 0;
	}
	// Read ints from the byte array
	dataPos    = *(int*)&(header[0x0A]);	
	imageSize  = *(int*)&(header[0x22]);
	width      = *(int*)&(header[0x12]);
	height     = *(int*)&(header[0x16]);
	// Some BMP files are misformatted, guess missing information
	if (imageSize==0)    imageSize=width*height*3; // 3 : one byte for each Red, Green and Blue component
	if (dataPos==0)      dataPos=54; // The BMP header is done that way
	// Create a buffer
	data = new unsigned char [imageSize]; 
	// Read the actual data from the file into the buffer
	fread(data,1,imageSize,file);
	//Everything is in memory now, the file can be closed
	fclose(file);
	// Create one OpenGL texture
   glPixelStorei(GL_UNPACK_ALIGNMENT, 1);

   glGenTextures(1, &texName);
   glBindTexture(GL_TEXTURE_2D, texName);

   glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, GL_CLAMP_TO_EDGE);
   glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, GL_CLAMP_TO_EDGE);
   glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, 
                   GL_LINEAR);
   glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, 
                   GL_LINEAR);
	glTexImage2D(GL_TEXTURE_2D, 0,GL_RGB, width, height, 0, GL_BGR, GL_UNSIGNED_BYTE, data);
}
