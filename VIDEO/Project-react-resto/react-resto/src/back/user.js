import React, { useState } from "react";
import axios from "../axios/link";
import useGet from "../hook/useGet";
import useDelete from "../hook/useDelete";
import { Modal, Button } from "react-bootstrap";

const User = () => {
  const { isi: users, setIsi: setUsers } = useGet("/user");
  const { pesan, hapus } = useDelete();
  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 5;

  const [showModal, setShowModal] = useState(false);
  const [formData, setFormData] = useState({
    email: "",
    password: "",
    level: "",
    relasi: "back"
  });
  const [loading, setLoading] = useState(false);
  const [errorMsg, setErrorMsg] = useState("");

  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentItems = users.slice(indexOfFirstItem, indexOfLastItem);
  const totalPages = Math.ceil(users.length / itemsPerPage);

  const handlePageChange = (pageNumber) => setCurrentPage(pageNumber);

  const handleDelete = (iduser) => {
    hapus("/user", iduser, setUsers);
  };

  const handleInputChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const toggleStatus = async (user) => {
    try {
      const updatedStatus = user.status === 1 ? 0 : 1;
  
      const response = await axios.put(`/user/${user.id}`, { status: updatedStatus });
  
      console.log("Response dari server:", response.data);
      // Update state users: hanya user yang diubah saja
      const updatedUsers = users.map(u =>
        u.id === user.id ? { ...u, status: updatedStatus } : u
      );
      setUsers(updatedUsers);
  
    } catch (err) {
      console.error("Gagal memperbarui status:", err);
      alert("Terjadi kesalahan saat mengubah status user.");
    }
  };
  

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setErrorMsg("");

    try {
      const response = await axios.post("/register", formData, {
        headers: {
          "Content-Type": "application/json",
        },
      });

      if (response.data) {
        // Refresh data users setelah berhasil register
        const refreshResponse = await axios.get("/user");
        setUsers(refreshResponse.data);
        
        setShowModal(false);
        setFormData({ email: "", password: "", level: "", relasi: "back" });
      }
    } catch (err) {
      console.error("Submit error:", err);
      setErrorMsg(err.response?.data?.message || err.message || "Terjadi kesalahan saat menambahkan user");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="p-4">
      <h2 className="d-flex justify-content-between align-items-center">
        Data User
        <button className="btn btn-success" onClick={() => setShowModal(true)}>
          Tambah User
        </button>
      </h2>

      {pesan && <div className="alert alert-success mt-3">{pesan}</div>}

      <table className="table table-bordered table-striped mt-4">
        <thead className="table-dark">
          <tr>
            <th>No</th>
            <th>User</th>
            <th>Level</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          {currentItems.length > 0 ? (
            currentItems.map((item, index) => (
              <tr key={item.id || `user-${indexOfFirstItem + index}`}>
                <td>{indexOfFirstItem + index + 1}</td>
                <td>{item.email}</td>
                <td>{item.level}</td>
                <td>
                <button
                  onClick={() => toggleStatus(item)} // <-- PERHATIKAN INI
                  className={`btn btn-sm ${item.status === 1 ? "btn-success" : "btn-danger"}`}
                >
                  {item.status === 1 ? "Aktif" : "Banned"}
                </button>
                </td>
                <td>
                  <button
                    onClick={() => handleDelete(item.iduser)}
                    className="btn btn-danger btn-sm"
                  >
                    Hapus
                  </button>
                </td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan="5" className="text-center">
                {users ? "Tidak ada data" : "Memuat data..."}
              </td>
            </tr>
          )}
        </tbody>
      </table>

      {users.length > 0 && (
        <nav className="mt-3">
          <ul className="pagination justify-content-center">
            <li className={`page-item ${currentPage === 1 ? "disabled" : ""}`}>
              <button className="page-link" onClick={() => handlePageChange(currentPage - 1)}>
                Previous
              </button>
            </li>
            {[...Array(totalPages)].map((_, index) => (
              <li key={`pagination-${index}`} className={`page-item ${currentPage === index + 1 ? "active" : ""}`}>
                <button className="page-link" onClick={() => handlePageChange(index + 1)}>
                  {index + 1}
                </button>
              </li>
            ))}
            <li className={`page-item ${currentPage === totalPages ? "disabled" : ""}`}>
              <button className="page-link" onClick={() => handlePageChange(currentPage + 1)}>
                Next
              </button>
            </li>
          </ul>
        </nav>
      )}

      <Modal show={showModal} onHide={() => setShowModal(false)} centered>
        <Modal.Header closeButton>
          <Modal.Title>Form Tambah User</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          {errorMsg && <div className="alert alert-danger">{errorMsg}</div>}

          <div className="mb-3">
            <label htmlFor="email" className="form-label">Email</label>
            <input
              type="email"
              id="email"
              name="email"
              className="form-control"
              value={formData.email}
              onChange={handleInputChange}
              required
            />
          </div>

          <div className="mb-3">
            <label htmlFor="password" className="form-label">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              className="form-control"
              value={formData.password}
              onChange={handleInputChange}
              required
            />
          </div>

          <div className="mb-3">
            <label htmlFor="level" className="form-label">Level</label>
            <select
              id="level"
              name="level"
              className="form-select"
              value={formData.level}
              onChange={handleInputChange}
            >
              <option value="admin">Admin</option>
              <option value="kasir">Kasir</option>
              <option value="koki">Koki</option>
            </select>
          </div>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={() => setShowModal(false)}>
            Batal
          </Button>
          <Button variant="primary" onClick={handleSubmit} disabled={loading}>
            {loading ? "Menyimpan..." : "Simpan"}
          </Button>
        </Modal.Footer>
      </Modal>
    </div>
  );
};

export default User;