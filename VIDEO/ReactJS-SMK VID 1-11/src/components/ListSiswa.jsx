function ListSiswa({ nama, kelas, jurusan }) {
  return (
    <div className="card mb-3">
      <div className="card-body">
        <h5 className="card-title">{nama}</h5>
        <p className="card-text mb-1">Kelas: {kelas}</p>
        <p className="card-text">Jurusan: {jurusan}</p>
        <button className="btn btn-info btn-sm">Lihat Detail</button>
      </div>
    </div>
  );
}

export default ListSiswa;