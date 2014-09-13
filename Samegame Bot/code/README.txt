###############################################################################################################################################

								THE BUBBLE BLAST GAME 

###############################################################################################################################################

In my implementation of solving this game i did following in my program
	
	* The input to the program is to be a numpy matrix
	
	* I have assumed that colors are in the range [1,N] where N is an integer not more than the product of input matrix's dimensions
		all colors from 1 to maximum color must be present.No colors must be missing from 1 to max color
	
	* I have assumed value 0 in matrix represents empty position in game
	
	* Final ouptput is in form [[(M1,s1),(M2,s2).......],score]
	
	* I have implemented 3 algorithms in my code:
		
		*solve()-->implements  strategy #1(blasting largest bubble of less frequent color if possible.if not blasting smallest bubble of more frequent color)
		*solve1()-->implements  strategy #2(blasting smallest bubble block of least frequent color if possible)
		*solve2()-->implements strategy #3(Random strategy)
	
	
##############################################################################################################################################
