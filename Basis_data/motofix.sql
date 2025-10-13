CREATE DATABASE motofix;
USE motofix;

-- Tables
CREATE TABLE pelanggan (
    pelanggan_id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20)
);

CREATE TABLE motor (
    motor_id INT AUTO_INCREMENT PRIMARY KEY,
    pelanggan_id INT,
    nomor_plat VARCHAR(10) UNIQUE,
    jenis_motor VARCHAR(50),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(pelanggan_id)
);

CREATE TABLE montir (
    montir_id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    spesialisasi VARCHAR(100),
    shift_kerja VARCHAR(50)
);

CREATE TABLE layanan (
    layanan_id INT AUTO_INCREMENT PRIMARY KEY,
    jenis_layanan VARCHAR(100) NOT NULL,
    harga DECIMAL(10,2),
    estimasi_waktu INT  -- dalam menit
);

CREATE TABLE jadwal_service (
    jadwal_id INT AUTO_INCREMENT PRIMARY KEY,
    pelanggan_id INT,
    motor_id INT,
    montir_id INT,
    tanggal DATE,
    jam TIME,
    status_booking VARCHAR(20),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(pelanggan_id),
    FOREIGN KEY (motor_id) REFERENCES motor(motor_id),
    FOREIGN KEY (montir_id) REFERENCES montir(montir_id)
);


CREATE TABLE detail_layanan (
    detail_id INT AUTO_INCREMENT PRIMARY KEY,
    jadwal_id INT,
    layanan_id INT,
    catatan TEXT,
    FOREIGN KEY (jadwal_id) REFERENCES jadwal_service(jadwal_id),
    FOREIGN KEY (layanan_id) REFERENCES layanan(layanan_id)
);