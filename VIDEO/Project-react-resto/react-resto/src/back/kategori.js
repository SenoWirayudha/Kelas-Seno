import React, { useState } from "react";
import axios from "../axios/link";
import { useForm } from "react-hook-form";
import useGet from "../hook/useGet"; // ⬅️ import custom hook

const Kategori = () => {
  const { register, handleSubmit, reset, setValue, formState: { errors } } = useForm();
  const { isi, setIsi } = useGet("/kategori"); // ⬅️ gunakan custom hook
  const [pesan, setPesan] = useState("");
  const [idkategori, setIdkategori] = useState("");
  const [pilihan, setPilihan] = useState("tambah");

  const refreshData = async () => {
    try {
      const response = await axios.get("/kategori");
      setIsi(response.data);
    } catch (error) {
      console.error("Error refreshing data:", error);
    }
  };

  const hapus = async (id) => {
    if (window.confirm('Apakah Anda yakin ingin menghapus data ini?')) {
      try {
        const response = await axios.delete(`/kategori/${id}`);
        setPesan(response.data.pesan);
        refreshData(); // ⬅️ panggil ulang data setelah hapus
      } catch (error) {
        console.error("Error deleting kategori:", error);
      }
    }
  };

  const onSubmit = async (data) => {
    try {
      if (pilihan === "tambah") {
        const response = await axios.post("/kategori", data);
        setPesan(response.data.pesan);
      } else {
        const response = await axios.put(`/kategori/${idkategori}`, data);
        setPesan(response.data.pesan);
        setPilihan("tambah");
        setIdkategori("");
      }
      reset();
      refreshData(); // ⬅️ panggil ulang data setelah tambah/ubah
    } catch (error) {
      console.error("Error submitting form:", error);
    }
  };

  const editData = (item) => {
    setValue("kategori", item.kategori);
    setValue("keterangan", item.keterangan);
    setIdkategori(item.idkategori);
    setPilihan("ubah");
  };

  return (
    <div className="p-4">
      <h2>Data Kategori</h2>

      {pesan && (
        <div className="alert alert-success mt-3">{pesan}</div>
      )}

      <div className="mt-1">
        <form onSubmit={handleSubmit(onSubmit)} className="mt-3">
          <div className="mb-3">
            <label className="form-label">Kategori:</label>
            <input
              type="text"
              className={`form-control ${errors.kategori ? 'is-invalid' : ''}`}
              {...register("kategori", { required: "Kategori harus diisi" })}
            />
            {errors.kategori && (
              <div className="invalid-feedback">{errors.kategori.message}</div>
            )}
          </div>

          <div className="mb-3">
            <label className="form-label">Keterangan:</label>
            <input
              type="text"
              className={`form-control ${errors.keterangan ? 'is-invalid' : ''}`}
              {...register("keterangan", { required: "Keterangan harus diisi" })}
            />
            {errors.keterangan && (
              <div className="invalid-feedback">{errors.keterangan.message}</div>
            )}
          </div>

          <button type="submit" className="btn btn-primary">
            {pilihan === "tambah" ? "Submit" : "Update"}
          </button>
        </form>
      </div>

      <table className="table table-striped table-bordered mt-4">
        <thead className="table-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Kategori</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          {isi.map((item, index) => (
            <tr key={item.idkategori}>
              <td>{index + 1}</td>
              <td>{item.kategori}</td>
              <td>{item.keterangan}</td>
              <td>
                <div className="d-flex gap-2">
                  <button
                    onClick={() => editData(item)}
                    className="btn btn-warning btn-sm"
                  >
                    Ubah
                  </button>
                  <button
                    onClick={() => hapus(item.idkategori)}
                    className="btn btn-danger btn-sm"
                  >
                    Hapus
                  </button>
               </div>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default Kategori;
