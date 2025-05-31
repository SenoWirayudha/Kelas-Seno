import React, { useState } from "react";
import axios from "../axios/link";
import useGet from "../hook/useGet";
import useDelete from "../hook/useDelete";
import { useForm } from "react-hook-form";

const Menu = () => {
  const { isi: menus = [], setIsi: setMenus } = useGet("/menu");
  const { isi: kategoris = [] } = useGet("/kategori");
  const { pesan: pesanHapus, hapus } = useDelete();
  const [pesan, setPesan] = useState("");
  const [editId, setEditId] = useState(null); // State baru untuk menyimpan ID yang diedit
  const [currentImage, setCurrentImage] = useState(null);

  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 5;

  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentItems = menus.slice(indexOfFirstItem, indexOfLastItem);
  const totalPages = Math.ceil(menus.length / itemsPerPage);

  const handlePageChange = (pageNumber) => {
    setCurrentPage(pageNumber);
  };

  const {
    register,
    handleSubmit,
    reset,
    setValue,
    formState: { errors },
  } = useForm();

  // Fungsi untuk mengisi form dengan data yang akan diedit
  const handleEdit = (menu) => {
    setEditId(menu.idmenu);
    setValue("menu", menu.menu);
    setValue("idkategori", menu.idkategori);
    setValue("harga", menu.harga);
    // Note: File input tidak bisa di-set secara langsung karena alasan keamanan
    setCurrentImage(menu.gambar);
  };

  const onSubmit = async (data) => {
    try {
      const formData = new FormData();
      formData.append("idkategori", data.idkategori);
      formData.append("menu", data.menu);
      formData.append("harga", data.harga);
      
      if (data.gambar && data.gambar[0]) {
        formData.append("gambar", data.gambar[0]);
      }

      let response;
      if (editId) {
        // Update menu
        formData.append("idmenu", editId);
        response = await axios.post(`/menu/${editId}`, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });
      } else {
        // Tambah menu baru
        response = await axios.post("/menu", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });
      }

      if (response.data) {
        const refreshResponse = await axios.get("/menu");
        setMenus(refreshResponse.data);
        setPesan(editId ? "Menu berhasil diubah" : "Menu berhasil ditambahkan");
        reset();
        setEditId(null); // Reset edit state
        setCurrentImage(null); // Reset gambar saat submit
        setCurrentPage(1);
        
        setTimeout(() => {
          setPesan("");
        }, 3000);
      }
    } catch (error) {
      console.error("Gagal:", error);
      setPesan(error.response?.data?.pesan || `Gagal ${editId ? 'mengubah' : 'menambahkan'} menu!`);
      setTimeout(() => {
        setPesan("");
      }, 3000);
    }
  };

  const handleDelete = (idmenu) => {
    hapus("/menu", idmenu, setMenus);
  };

  return (
    <div className="p-4">
      <div className="row">
      <h2 className="text-2xl font-bold mb-4">Daftar Menu</h2>
        <div className="mt-1">
          <form onSubmit={handleSubmit(onSubmit)}>
            <div className="mb-3">
              <div className="mb-3">
                <label htmlFor="menu" className="form-label">Nama Menu</label>
                <input 
                  type="text" 
                  className="form-control"
                  {...register("menu", { required: true })}
                />
                {errors.menu && <span className="text-danger">Nama menu harus diisi</span>}
              </div>
              
              <label htmlFor="kategori" className="form-label">Kategori</label>
              <select 
                className="form-select"
                {...register("idkategori", { required: true })}
              >
                <option value="">Pilih Kategori</option>
                {kategoris.map(kategori => (
                  <option key={kategori.idkategori} value={kategori.idkategori}>
                    {kategori.kategori}
                  </option>
                ))}
              </select>
              {errors.idkategori && <span className="text-danger">Kategori harus dipilih</span>}
            </div>

            <div className="mb-3">
              <label htmlFor="harga" className="form-label">Harga</label>
              <input 
                type="number" 
                className="form-control"
                {...register("harga", { required: true, min: 0 })}
              />
              {errors.harga && <span className="text-danger">Harga harus diisi dengan benar</span>}
            </div>

            <div className="mb-3">
              <label htmlFor="gambar" className="form-label">Gambar Menu</label>
              {currentImage && editId && (
                <div className="mb-2">
                  <img
                    src={currentImage}
                    alt="Current Menu"
                    style={{ width: "100px", height: "100px", objectFit: "cover" }}
                  />
                  <p>Gambar saat ini (opsional untuk ganti)</p>
                </div>
              )}
              <input 
                type="file" 
                className="form-control"
                accept="image/*"
                {...register("gambar", { required: !editId })} // Gambar tidak wajib saat update
              />
              {errors.gambar && <span className="text-danger">Gambar harus dipilih</span>}
            </div>

            <button type="submit" className="btn btn-primary">
              {editId ? "Update Menu" : "Tambah Menu"}
            </button>
            {editId && (
              <button 
                type="button" 
                className="btn btn-secondary ms-2"
                onClick={() => {
                  reset();
                  setEditId(null);
                  setCurrentImage(null); // Reset gambar saat batal
                }}
              >
                Batal
              </button>
            )}
          </form>

          {(pesan || pesanHapus) && (
            <div className="alert alert-success mt-3">
              {pesan || pesanHapus}
            </div>
          )}
        </div>
      </div>
      
      <table className="table table-bordered table-striped mt-4">
        <thead className="table-dark">
          <tr>
            <th>No</th>
            <th>Menu</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          {currentItems && currentItems.length > 0 ? (
            currentItems.map((item, index) => (
              <tr key={item.idmenu}>
                <td>{indexOfFirstItem + index + 1}</td>
                <td>{item.menu}</td>
                <td>{item.kategori}</td>
                <td>Rp {item.harga?.toLocaleString()}</td>
                <td>
                  <img
                    src={item.gambar}
                    alt={item.menu}
                    style={{ width: "80px", height: "80px", objectFit: "cover" }}
                  />
                </td>
                <td className="text-center">
                  <button
                    onClick={() => handleEdit(item)}
                    className="btn btn-warning btn-sm me-2"
                  >
                    Ubah
                  </button>
                  <button
                    onClick={() => handleDelete(item.idmenu)}
                    className="btn btn-danger btn-sm"
                  >
                    Hapus
                  </button>
                </td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan="6" className="text-center">
                {menus ? "Tidak ada data" : "Memuat data..."}
              </td>
            </tr>
          )}
        </tbody>
      </table>
      {/* Pagination tetap sama */}
      {menus.length > 0 && (
        <nav aria-label="Page navigation" className="mt-3">
          <ul className="pagination justify-content-center">
            <li className={`page-item ${currentPage === 1 ? 'disabled' : ''}`}>
              <button
                className="page-link"
                onClick={() => handlePageChange(currentPage - 1)}
                disabled={currentPage === 1}
              >
                Previous
              </button>
            </li>
            
            {[...Array(totalPages)].map((_, index) => (
              <li
                key={index + 1}
                className={`page-item ${currentPage === index + 1 ? 'active' : ''}`}
              >
                <button
                  className="page-link"
                  onClick={() => handlePageChange(index + 1)}
                >
                  {index + 1}
                </button>
              </li>
            ))}

            <li className={`page-item ${currentPage === totalPages ? 'disabled' : ''}`}>
              <button
                className="page-link"
                onClick={() => handlePageChange(currentPage + 1)}
                disabled={currentPage === totalPages}
              >
                Next
              </button>
            </li>
          </ul>
        </nav>
      )}
    </div>
  );
};

export default Menu;