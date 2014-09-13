import random
import numpy
from numpy import matrix
row_num=0#no. of rows in input matrix
col_num=0#no. of coloumns in input matrix
color_num=0#no. of colors in input matrix
INT_MIN=0#it signifies that a particulat position is empty
INT_MAX=-2#it signifies that a particulat position is ready to blast
arr=[]#it stores the matrix
color_arr=[]#it stores the data about blocks of each color
visited_arr=[]#its keeps record which cell location has been visited while finding a block
block_arr=[]#it stores the x,y coordinates of hte positons to be blasted
block_size=0#stores the block size
score=0#stores the score obtained
def findColor(i,j):
    '''returns the color of a given location (i,j)
        if location (i,j) is out of bounds returns INT_MIN'''
    global arr
    if((i>=row_num)or(i<0)or(j>=col_num)or(j<0)):#if the location (i,j) is out of bounds return INT_MIN
        return INT_MIN
    else:#otherwise return the color at location (i,j)
        return arr[i][j]
def isSingleton(i,j):
    '''checks whether cell (i,j) is singleton i.e. has any same color neighbours or not.
    if cell (i,j) is empty declares it as singleton
    returns 1 if it is singleton(i.e. no neighbours) otherwise 0'''
    global arr
    color=arr[i][j]#stores color at location (i,j)
    if (color==INT_MIN):#position is empty
        return 1
    #findcolor of all neighbouring cells
    a=findColor(i+1,j)#check color of location which is on down side
    b=findColor(i,j+1)#check color of location which is on right side
    c=findColor(i,j-1)#check color of location which is on left side
    d=findColor(i-1,j)#check color of location which is on up side
    if((a==color)or(b==color)or(c==color)or(d==color)):#compare with the color of all neighbouring cells
        return 0#i.e. not singleton
    else:
        return 1#i.e singleton
def isSolvable():
    '''checks whether puzzle can be actually solved further
    checks whether all the cells are singleton are not
    returns 1 if there is atleast 1 group in puzzle
    otherwise returns 0'''
    global arr
    global row_num
    global col_num
    for i in range(row_num):#iterate over all rows
        for j in range(col_num):#iterate over all coloumns
            flag=isSingleton(i,j)#check whether position (i,j) is singleton
            if(not flag):#check for return value of isSingleton(i,j)
                return 1#i.e. solvable a group of atleast 2 exists somewhere is puzzle
    return 0# not solvable..no more groups in puzzle
def doHorizontalGravity():
    '''implements horizontal gavity
        shifts the whole puzzle to the right if some coloumn goes empty'''
    global arr
    global row_num
    global col_num
    global color_num
    global block_arr
    global block_size
    global score
    shift=0
    last_row=row_num-1
    for i in range(col_num-1,-1,-1):
        if(arr[last_row][i]==INT_MIN):#if last cell in some coloumn is empty---> whole coloumn is empty--->therefore increase the shift
            shift=shift+1#increment the shift
        elif(shift==0):#if shift is zero do nothing
            continue
        else:
            for j in range(row_num):#shift the whole column to right by 'shift' no. of positions
                arr[j][i+shift]=arr[j][i]
    for i in range(shift):#leftmost 'shift' no. of coloumns has to be made empty
        if(arr[last_row][i]==INT_MIN):#INT_MIN signifies empty location
            continue
        else:
            for j in range(row_num):
                arr[j][i]=INT_MIN#make leftmost columns empty
    return
def doVerticalGravity(iprime, jprime):
    '''set the whole black i.e implements vertical gravity'''
    i=iprime
    while(arr[i][jprime]!=INT_MIN):#keep doing while you dont reach an empty cell
        if(i==0):
            arr[i][jprime]=INT_MIN
            break
        arr[i][jprime]=arr[i-1][jprime]#shift all the cells down
        i=i-1
def doDFS(i,j,color):
    '''fucntion which actually finds a block by doing dfs over  a given point'''
    global arr
    global row_num
    global col_num
    global color_num
    global block_arr
    global block_size
    global color_arr
    global score
    if((i<0)or(i>=row_num)or(j<0)or(j>=col_num)):#return if out of bounds
        return 0
    if(arr[i][j]==INT_MIN):#return if emptycell
        return 0
    if(arr[i][j]==INT_MAX):#return if already visited
        return 0
    if(arr[i][j]!=color):#return if color of neighbouring cell is different
        return 0

    arr[i][j]=INT_MAX#mark it visited
    block_arr[block_size][0]=i#add x-coordinate (row no.) of cell to block
    block_arr[block_size][1]=j#add y-coordinate (coloumn no.) of cell to block
    block_size=block_size+1#increade block size by 1

    #do DFS on all 4 neighbours
    doDFS(i-1,j,color)# dfs over up neighbour
    doDFS(i,j-1,color)#dfs over right neighbour
    doDFS(i+1,j,color)#dfs over down neighbour
    doDFS(i,j+1,color)#dfs over left neighbour
    
    return 1
def dofakeDFS(i,j,color):
    '''works similar to doDFS() except that it doesnot change original matrix whereas doDFS() does..hence the name dofakeDFS'''
    global arr
    global row_num
    global col_num
    global color_num
    global block_arr
    global block_size
    global color_arr
    global visited_arr
    global score
    if((i<0)or(i>=row_num)or(j<0)or(j>=col_num)):#out of bounds retrun 0
        return 0
    if(arr[i][j]==INT_MIN):#empty position return 0
        return 0
    if(visited_arr[i][j]==1):#instead of looking in original matrix looks in visited array if some cell is already visited
        return 0
    if(arr[i][j]!=color):#different color return zero
        return 0
    visited_arr[i][j]=1#instead of changing the original matrix make changes in visited array
                        #marks cell (i,j) visited
    block_arr[block_size][0]=i
    block_arr[block_size][1]=j
    block_size=block_size+1
    dofakeDFS(i-1,j,color)
    dofakeDFS(i,j-1,color)
    dofakeDFS(i+1,j,color)
    dofakeDFS(i,j+1,color)
    return 1
def comp(i,j):
    '''compare fucntion which helps i sorting the block in coloumn; row lexicographical order'''
    if(i[1]!=j[1]):#if coloumns are different
        return i[1]-j[1]#return difference in coloumn no.
    else:
        return i[0]-j[0]#else return differnce in row no.
def blockFindSet(i,j):
    '''driver function which finds the block at position (i,j) and sets the puzzle accordingly
        It returns the addition to score by blasting block at position(i,j) if possible
        otherwise returns 0'''
    global arr
    global row_num
    global col_num
    global color_num
    global block_arr
    global block_size
    global score
    color=arr[i][j]
    block_size=0
    flag=doDFS(i,j,color)#find a block by doing dfs
    if(not flag):#i.e flag=0 means cell(i,j) is out of bounds i.e. position is not on puzzle board
        return flag
    if(block_size==1):#if blocksize =1 then do not blast (i,j)
        arr[i][j]=color#resore the state of position (i,j)
        return 0
    temp=block_arr[:block_size]
    temp.sort(cmp=comp)#sort the temp(block) array
    for i in range(block_size):
        doVerticalGravity(temp[i][0],temp[i][1])#blast the cell(temp[i][0],temp[i][1]) and rearrange other bubbles according to vertical gravity
    doHorizontalGravity()#implement horizontal gravty..shifts coloumns to the right
    #print "score added="+`block_size**2`
    addition=block_size*block_size#recor the increase in score
    block_size=0
    return addition
def setColorArray():
    '''finds the smallest and largest possible block preferebly at upper side of matrix for each color'''
    global arr
    global row_num
    global col_num
    global color_num
    global block_arr
    global color_arr
    global visited_arr
    global block_size
    global score

    for i in range (row_num):
        for j in range (col_num):
            color=arr[i][j]
            if(visited_arr[i][j]==0):#i.e. not visited
                block_size=0
                flag=dofakeDFS(i,j,color)#find the block bu without altering the input matrix...thats why owrd 'fake'
                if(flag):
                    if((block_size>1)and ((color_arr[color][2]==None)or (color_arr[color][2]>block_size))):#record smallest block
                        color_arr[color][0]=i#store x coordinate
                        color_arr[color][1]=j#store y coordinate
                        color_arr[color][2]=block_size#store block size
                    if((block_size>1)and ((color_arr[color][5]==None)or (color_arr[color][5]<block_size))):#records largest block
                        color_arr[color][3]=i#store x coordinate
                        color_arr[color][4]=j#store y coordinate
                        color_arr[color][5]=block_size#store block size
                    
                        
def setInitialColorCount(countpos):
    '''It finds and stores the initial count of  each color in color_arr'''
    global arr
    global row_num
    global col_num
    global color_num
    global block_arr
    global color_arr
    global visited_arr
    global block_size
    global score

    for i in range(row_num):
        for j in range(col_num):
            color_arr[arr[i][j]][countpos]+=1#increase the frequrency of the color by 1
            color_arr[arr[i][j]][countpos+1]=arr[i][j]
def cal_color_num():
    '''Calculates the number of color in input matrix'''
    '''assumes that all colors are present form 1 to max_color'''
    global arr
    global color_num
    color_num=0
    for i in range(row_num):
        for j in range(col_num):
            if(arr[i][j]>color_num):
                color_num=arr[i][j]#record the  maximum possibe color achieved
    color_num=int(color_num)

def color_sort(i,j):
    '''sorts color according to no. of occurences(frequency)'''
    return i[6]-j[6]
def converttoInt():
    '''converts the input floating pt. matix into integer matrix'''
    global arr
    for i in range(row_num):
        for j in range (col_num):
            arr[i][j]=int(arr[i][j])#typecasted into int

def solve(M):
    '''driver function which drives the whole puzzle solving'''
    global arr
    arr=M.tolist()
    
    global row_num
    global col_num
    global color_num
    global block_arr
    global color_arr
    global visited_arr
    global block_size
    global score
    row_num=len(arr)#calculate no. of rows
    col_num=len(arr[0])#calculate no. of coloumns
    cal_color_num()#calculate no. of colors
    converttoInt()
    score=0#initialize score to zero
    block_arr=[]
    color_arr=[]
    visited_arr=[]
    output=[]
    output.append([])
    block_size=0
    for i in range (row_num):
        visited_arr.append([])
        for j in range (col_num):
            visited_arr[i].append(0)#create visited array whose dimensions is equal to that of input matrix
    for i in range(row_num*col_num):
        block_arr.append([None,None])#create a block array  
                               
    for i in range(color_num+1):
        color_arr.append([None,None,None,None,None,None,0,None])#denotes(i_max,j_max,biggest_block_size,i_min,j_min,least_block_size,color_remaining,color_index)
    countpos=6  
    setInitialColorCount(countpos)#initialize the color_arr
    while(isSolvable()):#keep doing untill matrix is unsolvable
        for i in range (row_num):
            for j in range (col_num):
                visited_arr[i][j]=0#mark all positions as univisited
        setColorArray()#find the minimum,maximum block and frequency of each color
        temp=list(color_arr[1:])
        temp.sort(cmp=color_sort)
        minimum=-1
        ma=-1
        for i in range(color_num):
            if (temp[i][5]!=None):
                minimum=i
                break
        '''for i in range(color_num-1,-1,-1):
            if(temp[i][5]!=None):
                ma=i
                break'''
                
        #frac=0.25*(temp[minimum][6]**2)*1.0/temp[ma][6]**2
        #frac+=0.25*temp[minimum][6]/temp[ma][6]
        #frac+=0.25*temp[minimum][5]/temp[ma][5]
        #frac+=0.25*(temp[minimum][5]**2)*1.0/temp[ma][5]**2
        frac=1*1.0/3
        frac=frac*color_num
        if (minimum>(frac)):
            iprime=temp[minimum][0]
            jprime=temp[minimum][1]
            index=temp[minimum][7]
            color_arr[index][countpos]-=color_arr[index][2]
        else:
            iprime=temp[minimum][3]
            jprime=temp[minimum][4]
            index=temp[minimum][7]
            color_arr[index][countpos]-=color_arr[index][5]
        score_added=blockFindSet(iprime,jprime)#blast the bubbles at position (iprime,jprime)
        score+=score_added#increase the score

        c=matrix(arr)#obtain matrix of present state of puzzle
        output[0].append(tuple([c,score_added]))#append it in output list
        #output.append(score_added)#store the esentials into the output list
        for i in range((color_num+1)):
            color_arr[i][0]=None
            color_arr[i][1]=None
            color_arr[i][2]=None
            color_arr[i][3]=None
            color_arr[i][4]=None
            color_arr[i][5]=None
    color_arr=[]
    block_size=0
    output.append(score)#append the final score into output list
    return output
def solve1(M):
    '''driver function which drives the whole puzzle solving'''
    global arr
    arr=M.tolist()
    global row_num
    global col_num
    global color_num
    global block_arr
    global color_arr
    global visited_arr
    global block_size
    global score
    row_num=len(arr)#calculate no. of rows
    col_num=len(arr[0])#calculate no. of coloumns
    cal_color_num() #calculate no. of colors
    score=0#initialize score to zero
    converttoInt()
    block_arr=[]
    color_arr=[]
    visited_arr=[]
    block_size=0#initialize block_size to zero
    output=[]
    output.append([])
    
    for i in range (row_num):
        visited_arr.append([])
        for j in range (col_num):
            visited_arr[i].append(0)#create visited array whose dimensions is equal to that of input matrix
    for i in range(row_num*col_num):
        block_arr.append([None,None]) #create a block array   
    for i in range(color_num+1):
        color_arr.append([None,None,None,None,None,None,0,None])#denotes(i_max,j_max,biggest_block_size,i_min,j_min,least_block_size,color_remaining,color_index)
    countpos=6  
    setInitialColorCount(countpos)#initialize the color_arr
    while(isSolvable()):#keep doing untill matrix is unsolvable
        for i in range (row_num):
            for j in range (col_num):
                visited_arr[i][j]=0#mark all positions as univisited
        setColorArray()#find the minimum,maximum block and frequency of each color
        minimum=1
        for i in range(1,color_num+1):
            if((color_arr[i][2]!=None)and(color_arr[i][countpos]>0)):#iterate over colors untill a color is found whose block is possible
                minimum=i
                break
        for i in range(minimum,color_num+1):#iterate over all colors and select the block of minimum size belonging to color of minimum occurence if possible
            if((color_arr[i][2]!=None)and(color_arr[i][countpos]>0)and(color_arr[i][countpos]<color_arr[minimum][countpos])):
                minimum=i
        iprime=color_arr[minimum][0]
        jprime=color_arr[minimum][1]
        score_added=blockFindSet(iprime,jprime)#blast the bubbles at position (iprime,jprime)
        score+=score_added#increase the score
        color_arr[minimum][countpos]-=color_arr[minimum][2]#decrese the count of color whose bubbles are blasted
	c=matrix(arr)#obtain matrix of present state of puzzle

        output[0].append(tuple([c,score_added]))#append it in output list
        
        for i in range(color_num+1):
            color_arr[i][0]=None
            color_arr[i][1]=None
            color_arr[i][2]=None
    color_arr=[]
    block_size=0
    output.append(score)#append the final score int output list
    return output
def solve2(M):
    '''implements random strategy'''
    global arr
    arr=M.tolist()
    global row_num
    global col_num
    global color_num
    global block_arr
    global block_size
    global score
    output=[]
    output.append([])
    row_num=len(arr)#calculate no. of rows
    col_num=len(arr[0])#calculate no. of coloumns
    cal_color_num()#calculate no. of colors
    converttoInt()
    score=0
    block_arr=[]
    for i in range(row_num*col_num):
            block_arr.append([None,None])
    block_size=0
    while(isSolvable()):
        iprime=random.randint(0,row_num-1)
        jprime=random.randint(0,col_num-1)
        score_added=blockFindSet(iprime,jprime)#blast the bubbles at position (iprime,jprime)
        if(score_added>0):
            score+=score_added#increase the score
            c=matrix(arr)
            output[0].append(tuple([c,score_added]))#append it in output list
        k_size=0
    output.append(score)
    return output

