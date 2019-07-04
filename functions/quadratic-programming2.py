import numpy as np
from numpy import linalg
import cvxopt
from cvxopt import matrix, solvers
#untuk rbf kernel
from sklearn.metrics.pairwise import rbf_kernel

##ini X1 dengan label positif +1
xdata = ([[1,1,0,0,0,0,0,0,1],
[0.2,0,0.1,0,0,1,0.2,0,0.1],
[1,1,0,0,0,0,0,0,0],
[0,0,1,1,0,1,0,1,0],
[0,0,1,1,0,1,0,1,0],
[0,0,1,1,0,1,0,1,0],
[0,0,1,1,0,1,0,1,0],
[0,0,1,1,0,1,0,1,0],
[0,0,1,1,0,1,0,1,0],
[0,0,1,1,0,0,0,0,0]])
ydata = ([-1.,1.,-1.,-1,-1,-1.,-1.,-1.,-1.,-1.])

# #ini X2 dengan label positif +1
# xdata = ([[8.09,13.50,1.47,19.73,32.23,4.84],
# [4.58,7.43,2.64,13.38,21.55,7.83],
# [3.96,5.76,3.13,13.01,18.86,10.37]])
# ydata = ([-1.,1.,-1])

# #ini X3 dengan label positif +1
# xdata = ([[8.09,13.50,1.47,19.73,32.23,4.84],
# [4.58,7.43,2.64,13.38,21.55,7.83],
# [3.96,5.76,3.13,13.01,18.86,10.37]])
# ydata = ([-1.,-1.,1])

x = np.vstack(xdata)
y = np.hstack(ydata)

# print (x)
# print (y)

#bagian awal hitung kernel rbf
# print ("bagian awal hitung kernel rbf")
# print ("banyak array x = ", len(x))
n_data, n_fitur = x.shape
# print (n_data)
# buat matriks nol
K = np.zeros((n_data, n_data))
for i in range(n_data):
    for j in range(n_data):
        K[i,j] = rbf_kernel(x[[i]], x[[j]], 0.5)

# print ("hasil matriks kernel rbf")
# print (K)
#bagian akhir hitung kernel rbf

# bagian awal pembulatan kernel rbf agar hasil persamaan lagrange-nya sesuai syarat
simpan_kernel_pembulatan = []
nkernelb,nkernelk = K.shape
for banyakkerneli in range(nkernelb):
    for banyakkernelj in range(nkernelk):
        if len(str(K[banyakkerneli][banyakkernelj])) > 3:
            simpan_kernel_pembulatan.append(len(str(K[banyakkerneli][banyakkernelj])))
# print ("append array pembulatan K")
# print (simpan_kernel_pembulatan)

min_data_k = min(simpan_kernel_pembulatan) - 2
#kondisi cek apakah mengandung decimal atau tidak
if min_data_k >=1:
    nilaipembulatank = min_data_k
else:
    nilaipembulatank = 0
# print ("nilai pembulatan untuk K sebanyak ", nilaipembulatank)
#bagian awal buat ulang data K hasil pembulatan
# print ("kernel K hasil pembulatan")
for kernelbarui in range(nkernelb):
    for kernelbaruj in range(nkernelk):
        K[kernelbarui][kernelbaruj] = np.round(K[kernelbarui][kernelbaruj], nilaipembulatank)

        # print (K[kernelbarui][kernelbaruj])
#bagian akhir buat ulang data K hasil pembulatan

# bagian akhir pembulatan kernel rbf agar hasil persamaan lagrange-nya sesuai syarat

# bagian awal hitung lagrange dualitas lalu mendapatkan alpha dan bias
# print ("bagian training svm lagrange dualitas")
NUM = K.shape[0]
DIM = K.shape[1]
# dualitas lagrange dipecahkan

# K dari perhitungan kernel RBF

#bagian awal hitung alpha
P = matrix(K)
q = matrix(-np.ones((NUM, 1)))
G = matrix(-np.eye(NUM))
h = matrix(np.zeros(NUM))
A = matrix(y.reshape(1, -1))
# print (A)
b = matrix(np.zeros(1))
#memunculkan solvers progress
solvers.options['show_progress'] = False
# bagian mencari nilai optimal lagrange dualitas dengan QP
sol = solvers.qp(P, q, G, h, A, b)
#didapatkan nilai alpha
alphas = np.array(sol['x'])
alpha1d = np.ravel(sol['x'])

# print ("Alpha 1 D Array")
# print (alpha1d)
#bagian akhir hitung alpha


# untuk variabel cari min data panjang karakter
min_data = []

# get weights
w = np.sum(alphas * y[:, None] * K, axis = 0)
# get bias
cond = (alphas > 0).reshape(-1)
b = y[cond] - np.dot(K[cond], w)
bias = b[0]


# print("nilai alpha ", alphas)
#untuk mengetahui berapa banyak alpha yang ada
banyakdtalpha = len(alphas)
#bagian awal menampilkan panjang kararkter nilai alpha
##print ("nilai alpha di numpy round",np.round(alphas, 2))
# for tampili in range(banyakdtalpha):
    # print ("cek panjang karakter nilai alpha", tampili+1,len(str(alphas[tampili][0])))
#bagian akhir menampilkan panjang kararkter nilai alpha

#bagian awal memasukan panjang karakter yang ada pada setiap alpha
for banyaki in range(banyakdtalpha):
    min_data.append(len(str(alphas[banyaki][0])))
##print ("min data length karakter alpha", min(min_data))
mulaisetelahkoma = min(min_data) - 2
#kondisi cek apakah mengandung decimal atau tidak
if mulaisetelahkoma >=1:
    pdalpha = mulaisetelahkoma
else:
    pdalpha = 0
#bagian akhir memasukan panjang karakter yang ada pada setiap alpha

# print ("nilai pembulatan untuk alpha sebanyak ", pdalpha)
#bagian awal menampilkan dan mencoba memasukan nilai alpha kedalam syarat persamaan
hasilpengurangan = 0
for tampilai in range(banyakdtalpha):
    print (np.round(alphas[tampilai][0], pdalpha),",")
    # print ("nilai alpha",tampilai+1,"adalah",np.round(alphas[tampilai][0], pdalpha))
    # jika data awal maka ditambahkan dulu, jika tidak maka dikurangkan
    if tampilai == 0:
        hasilpengurangan = np.round(hasilpengurangan, pdalpha) + np.round(alphas[tampilai][0], pdalpha)
        # print (np.round(hasilpengurangan, pdalpha))
    else:
        hasilpengurangan = np.round(hasilpengurangan, pdalpha) - np.round(alphas[tampilai][0], pdalpha)
        # print (np.round(hasilpengurangan, pdalpha))
##    print ("hasil pengurangan ",hasilpengurangan)
#bagian akhir menampilkan dan mencoba memasukan nilai alpha kedalam syarat persamaan

# print ("jika dimasukan nilai alpha ke persamaan adalah ", hasilpengurangan)
##print("pake round biasa, masukkan ke persamaan jadi nilainya adalah ",np.round(alphas[0][0] - alphas[1][0] - alphas[2][0]))
# print(w)
# print ("nilai bias di bulatkan berdasarkan pembulatan alpha adalah ", round(bias, pdalpha))
# print(bias)
# print(K[cond])
# print(w)
# print(np.dot(K[cond],w))
# bagian akhir hitung lagrange dualitas lalu mendapatkan alpha dan bias
