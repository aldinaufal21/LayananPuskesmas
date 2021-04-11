## DOKUMENTASI API PUSKESMAS

## ENDPOINT API

1. get poli
* [GET] (https://puskesmas.ekopz.id/api/poli)

2. get antrian
* [GET] (https://puskesmas.ekopz.id/api/antrian/<id_pasien>)

3. get praktik
* [GET] (https://puskesmas.ekopz.id/api/praktik)

4. dokter
* get dokter
    * [GET] (https://puskesmas.ekopz.id/api/dokter)
* get dokter by id_dokter
    * [GET] (https://puskesmas.ekopz.id/api/dokter/id/<id_dokter>) 
* get dokter by id_poli
    * [GET] (https://puskesmas.ekopz.id/api/dokter/poli/<id_poli>)

5. pasien
* get pasien
    * [GET] (https://puskesmas.ekopz.id/api/pasien)
* get pasien by id_pasien
    * [GET] (https://puskesmas.ekopz.id/api/pasien/id/<id_pasien>)
* registrasi pasien
    * [POST] (https://puskesmas.ekopz.id/api/register)
* login pasien
    * [POST] (https://puskesmas.ekopz.id/api/login)
* update pasien
    * [POST] (https://puskesmas.ekopz.id/api/pasien/update/<id_pasien>)
* delete pasien
    * [POST] (https://puskesmas.ekopz.id/api/pasien/delete/<id_pasien>)

6. Pemeriksaan
* get pemeriksaan by id_pasien
    * [GET] (https://puskesmas.ekopz.id/api/pemeriksaan/id/<id_pasien>)
* add pemeriksaan
    * [POST] (https://puskesmas.ekopz.id/api/pemeriksaan/add)
* delete pemeriksaan
    * [GET] (https://puskesmas.ekopz.id/api/pemeriksaan/delete/<id_pemeriksaan>)

## RESPON API

1. get poli
* [GET] (https://puskesmas.ekopz.id/api/poli)
```
Respon berhasil :
{
    "status": 200,
    "data": {
        "poli": [
            {
                "id": 1,
                "nama_poli": "jantung",
                "kode_antrian": "J",
                "created_at": "2021-03-11T23:38:14.000000Z",
                "updated_at": "2021-03-11T23:38:14.000000Z"
            },
        ]
    }
}
```

2. get antrian
* [GET] (https://puskesmas.ekopz.id/api/antrian/<id_pasien>)

3. get praktik
* [GET] (https://puskesmas.ekopz.id/api/praktik)
```
Respon Berhasil :
{
    "status": 200,
    "data": {
        "praktik": [
            {
                "id": 4,
                "mulai": "2021-04-07 15:04:00",
                "berakhir": "2021-04-07 20:00:00",
                "id_dokter": 3,
                "created_at": "2021-04-07T08:04:47.000000Z",
                "updated_at": "2021-04-07T08:04:47.000000Z"
            }
        ]
    }
}
```

4. dokter
* get dokter
* [GET] (https://puskesmas.ekopz.id/api/dokter)
```
Respon Berhasil :
{
    "status": 200,
    "data": {
        "dokter": [
            {
                "id": 1,
                "nama": "Aldy Naufal Alyyafi",
                "ttl": "1996-05-12",
                "jenis_kelamin": "Laki-Laki",
                "alamat": "jalan sukabirus no a1a",
                "poli_id": 1,
                "created_at": "2021-03-11T23:41:02.000000Z",
                "updated_at": "2021-03-11T23:41:02.000000Z"
            },
        ]
    }
}
```

* get dokter by id_dokter
* [GET] (https://puskesmas.ekopz.id/api/dokter/id/<id_dokter>)
```
Respon Berhasil :
{
    "status": 200,
    "data": {
        "dokter": {
            "id": 1,
            "nama": "Rifa Azkia",
            "ttl": "2000-08-20",
            "jenis_kelamin": "Perempuan",
            "alamat": "jalan tb hasan kp cimesir rt 01/04 Rangkasbitung timur kab lebak",
            "poli_id": 3,
            "created_at": "2021-03-11T23:40:06.000000Z",
            "updated_at": "2021-03-11T23:40:06.000000Z"
        }
    }
}
```
```
Data tidak ada :
{
    "status": 404,
    "message": "dokter not found"
} 
```

* get dokter by id_poli
* [GET] (https://puskesmas.ekopz.id/api/dokter/poli/<id_poli>)
```
Respon Berhasil :
{
    "status": 200,
    "data": {
        "dokter": [
            {
                "id": 2,
                "nama": "Aldy Naufal Alyyafi",
                "ttl": "1996-05-12",
                "jenis_kelamin": "Laki-Laki",
                "alamat": "jalan sukabirus no a1a",
                "poli_id": 1,
                "created_at": "2021-03-11T23:41:02.000000Z",
                "updated_at": "2021-03-11T23:41:02.000000Z"
            }
        ]
    }
}
```

```
Data tidak ada :
{
    "status": 404,
    "message": "dokter not found"
} 
```

5. pasien
* get pasien
* [GET] (https://puskesmas.ekopz.id/api/pasien)
```
Respon Berhasil :
{
    "status": 200,
    "data": {
        "pasien": [
            {
                "id": 1,
                "nama": "fauzan maulana",
                "alamat": "bandung barat",
                "berat_badan": 50,
                "tinggi_badan": 170,
                "gol_darah": "ab",
                "tgl_lahir": "2000-03-20",
                "no_hp": "0895618959450",
                "created_at": "2021-03-12T00:49:34.000000Z",
                "updated_at": "2021-03-12T00:49:34.000000Z",
                "jenis_kelamin": 1
            }
        ]
    }
}
```


* get pasien by id_pasien
* [GET] (https://puskesmas.ekopz.id/api/pasien/id/<id_pasien>)
```
Respon Berhasil :
{
    "status": 200,
    "data": {
        "pasien": {
            "id": 1,
            "nama": "fauzan maulana",
            "alamat": "bandung barat",
            "berat_badan": 50,
            "tinggi_badan": 170,
            "gol_darah": "ab",
            "tgl_lahir": "2000-03-20",
            "no_hp": "0895618959450",
            "created_at": "2021-03-12T00:49:34.000000Z",
            "updated_at": "2021-03-12T00:49:34.000000Z",
            "jenis_kelamin": 1
        }
    }
}
```

```
Data Tidak Ada :
{
    "status": 404,
    "message": "pasien not found"
}
```

* registrasi pasien
[POST] (https://puskesmas.ekopz.id/api/register)
- Field :
  - nama (string),
  - alamat (string), 
  - jenis_kelamin (integer: 1 (laki-laki), 2 (perempuan)), 
  - berat_badan (integer), 
  - tinggi_badan (integer), 
  - gol_darah (string), 
  - tgl_lahir (date), 
  - no_hp (string), 
  - email (string), 
  - password (string), 
  - no_ktp (string), 
  - foto_ktp (string),
  
```
Respon Berhasil :
{
    "status": 200,
    "message": "Pasien created !"
}
```

```
Respon validasi form error : 
{
    "status": 401,
    "description": "Error !",
    "data": {
        "no_hp": [
            "The no hp has already been taken."
        ],
        "tgl_lahir": [
            "The tgl lahir field is required."
        ],
        "email": [
            "The email has already been taken."
        ]
    }
}
```

* login pasien
[POST] (https://puskesmas.ekopz.id/api/login)
- Field : 
  - no_hp (string), 
  - password (string),
  
```
Respon Berhasil :
{
    "status": 200,
    "message": "login successfully !",
    "data": {
        "pasien": {
            "id": 1,
            "nama": "fauzan maulana",
            "alamat": "bandung barat",
            "berat_badan": 50,
            "tinggi_badan": 170,
            "gol_darah": "ab",
            "tgl_lahir": "2000-03-20",
            "no_hp": "0895618959450",
            "created_at": "2021-03-12T00:49:34.000000Z",
            "updated_at": "2021-03-12T00:49:34.000000Z",
            "jenis_kelamin": 1
        }
    }
}
```

* update pasien
[POST] (https://puskesmas.ekopz.id/api/pasien/update/<id_pasien>)
- Field : 
  - nama (string), 
  - alamat (string), 
  - jenis_kelamin (integer: 1 (laki-laki), 2 (perempuan)), 
  - berat_badan (integer), 
  - tinggi_badan (integer), 
  - gol_darah (string), 
  - tgl_lahir (date), 
  - no_hp (string), 
  - email (string), 
  - password (string)

```
Respon Berhasil : 
{
    "status": 200,
    "message": "pasien updated !"
}
```

* delete pasien
* [GET] (https://puskesmas.ekopz.id/api/pasien/delete/<id_pasien>)
```
Respon Berhasil : 
{
    "status": 200,
    "message": "pasien deleted !"
}
```

6. pemeriksaan
* get pemeriksaan by id_pasien
* [GET] (https://puskesmas.ekopz.id/api/pemeriksaan/id/<id_pasien>)
```
Respon Berhasil :
{
    "status": 200,
    "data": {
        "pemeriksaan": [
            {
                "id": 1,
                "id_poli": 1,
                "keluhan": "tidak enak badan",
                "id_pasien": 1,
                "hasil_pemeriksaan": null,
                "status_pemeriksaan": 1,
                "status": 2,
                "cetak": 1,
                "created_at": "2021-03-17T00:23:32.000000Z",
                "updated_at": "2021-03-17T00:45:10.000000Z"
            }
        ]
    }
}
```
```
Data Tidak ada :
{
    "status": 404,
    "message": "pemeriksaan not found"
}
```

* add pemeriksaan
[POST] (https://puskesmas.ekopz.id/api/pemeriksaan/add)
- Field :
  - tanggal (date)
  - id_poli (integer)
  - keluhan (string)
  - id_pasien (integer)
  
```
Respon Berhasil :
{
    "status": 200,
    "message": "pemeriksaan created !"
}
```

* delete pemeriksaan
* [GET] (https://puskesmas.ekopz.id/api/pemeriksaan/delete/<id_pemeriksaan>)
``` 
Respon Berhasil :
{
    "status": 200,
    "message": "pemeriksaan deleted !"
}
```

## ERROR STATUS 

* status : 
  * 200 - ok/created/updated/deleted
  * 404 - not found
  * 401 - field ada yang kosong

