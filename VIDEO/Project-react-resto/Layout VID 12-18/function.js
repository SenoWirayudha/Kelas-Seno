const dataSiswa = [
    { id: 1, nama: "Budi", kelas: "X RPL 1", alamat: "Jakarta" },
    { id: 2, nama: "Ani", kelas: "X RPL 1", alamat: "Bandung" },
    { id: 3, nama: "Siti", kelas: "X RPL 2", alamat: "Surabaya" },
    { id: 4, nama: "Rudi", kelas: "X RPL 2", alamat: "Semarang" }
];

export function get() {
    return dataSiswa;
}

export function show(id) {
    return dataSiswa.find(siswa => siswa.id === parseInt(id));
}