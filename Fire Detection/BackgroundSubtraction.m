function [D] =BackgroundSubtraction(B,F,T)
D=(abs(F-B))>T;
end