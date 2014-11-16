function [ B_new] = GetUpdatedBackground(B_prev,F_prev,beta)
B_new= beta*B_prev+(1-beta)*F_prev;
end