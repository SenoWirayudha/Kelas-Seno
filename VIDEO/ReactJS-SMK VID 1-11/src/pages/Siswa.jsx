import ListSiswa from '../components/ListSiswa';

function Siswa() {
  const daftarSiswa = [
    { nama: 'Ahmad Rizki', kelas: 'XII', jurusan: 'RPL' },
    { nama: 'Siti Nurhaliza', kelas: 'XI', jurusan: 'TKJ' },
    { nama: 'Budi Santoso', kelas: 'X', jurusan: 'MM' }
  ];

  return (
    <div className="siswa">
      <div className="container py-4">
        <h1 className="mb-4">Daftar Siswa</h1>
        <div className="row">
          {daftarSiswa.map((siswa, index) => (
            <div className="col-md-4" key={index}>
              <ListSiswa
                nama={siswa.nama}
                kelas={siswa.kelas}
                jurusan={siswa.jurusan}
              />
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}

export default Siswa;