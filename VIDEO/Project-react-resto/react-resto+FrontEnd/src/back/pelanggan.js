import React from "react";
import useGet from "../hook/useGet";
import useDelete from "../hook/useDelete";

const Pelanggan = () => {
  const { isi, setIsi } = useGet("/pelanggan");
  const { pesan, hapus } = useDelete();

  console.log('Data pelanggan:', isi);

  return (
    <div className="p-4">
      <h2 className="text-2xl font-bold mb-4">Daftar Pelanggan</h2>

      {pesan && (
        <div className="alert alert-success mt-3">{pesan}</div>
      )}
      <div className="overflow-x-auto">
        <table className="table table-bordered table-striped">
          <thead className="table-dark">
            <tr>
              <th className="border px-4 py-2">No</th>
              <th className="border px-4 py-2">Pelanggan</th>
              <th className="border px-4 py-2">Alamat</th>
              <th className="border px-4 py-2">Telp</th>
              <th className="border px-4 py-2">Aksi</th>
            </tr>
          </thead>
          <tbody>
            {isi.length > 0 ? (
              isi.map((data, index) => (
                <tr key={data.idpelanggan || index} className="hover:bg-gray-50">
                  <td className="border px-4 py-2 text-center">{index + 1}</td>
                  <td className="border px-4 py-2">{data.pelanggan}</td>
                  <td className="border px-4 py-2">{data.alamat}</td>
                  <td className="border px-4 py-2">{data.telp}</td>
                  <td className="border px-4 py-2 text-center">
                    <button
                      onClick={() => hapus("/pelanggan", data.idpelanggan, setIsi)}
                      className="btn btn-danger btn-sm"
                    >
                      Hapus
                    </button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="5" className="text-center py-4">
                  Tidak ada data pelanggan.
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default Pelanggan;
