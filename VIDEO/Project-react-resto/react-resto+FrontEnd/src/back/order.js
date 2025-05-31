import React, { useState, useEffect } from "react";
import useGet from "../hook/useGet";
import useDelete from "../hook/useDelete";
import axios from "../axios/link";
import { Modal, Button } from "react-bootstrap";

const Order = () => {
  const { isi: orders = [], setIsi: setOrders } = useGet("/order");
  const { pesan, hapus } = useDelete();
  const [currentPage, setCurrentPage] = useState(1);
  const [startDate, setStartDate] = useState("");
  const [endDate, setEndDate] = useState("");
  const [filteredOrders, setFilteredOrders] = useState([]);
  const [showModal, setShowModal] = useState(false);
  const [selectedOrder, setSelectedOrder] = useState(null);
  const [bayar, setBayar] = useState("");
  const itemsPerPage = 5;

  const handleSearch = () => {
    const filtered = orders.filter((order) => {
      const orderDate = new Date(order.tglorder);
      const start = startDate ? new Date(startDate) : null;
      const end = endDate ? new Date(endDate) : null;

      if (start && orderDate < start) return false;
      if (end && orderDate > end) return false;

      return true;
    });
    setFilteredOrders(filtered);
    setCurrentPage(1);
  };

  const handleReset = () => {
    setStartDate("");
    setEndDate("");
    setFilteredOrders([]);
    setCurrentPage(1);
  };

  const dataToDisplay =
    filteredOrders.length > 0 || (startDate || endDate)
      ? filteredOrders
      : orders;

  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentItems = dataToDisplay.slice(indexOfFirstItem, indexOfLastItem);
  const totalPages = Math.ceil(dataToDisplay.length / itemsPerPage);

  const handlePageChange = (pageNumber) => {
    setCurrentPage(pageNumber);
  };

  const handleDelete = (idorder) => {
    hapus("/order", idorder, setOrders);
  };

  const openPelunasanModal = (order) => {
    setSelectedOrder(order);
    setBayar(order.total - order.bayar); // default isi kekurangan
    setShowModal(true);
  };

  const handleCloseModal = () => {
    setShowModal(false);
    setSelectedOrder(null);
    setBayar("");
  };

  const handleSimpanPelunasan = async () => {
    if (!selectedOrder) return;

    const newBayar = parseInt(bayar);
    const updatedOrder = {
      bayar: selectedOrder.bayar + newBayar,
      kembali: selectedOrder.bayar + newBayar - selectedOrder.total,
      status: selectedOrder.bayar + newBayar >= selectedOrder.total ? 1 : 0,
    };

    try {
      await axios.put(`/order/${selectedOrder.idorder}`, updatedOrder);
      const res = await axios.get("/order");
      setOrders(res.data);
      handleCloseModal();
    } catch (err) {
      console.error("Gagal update order:", err);
    }
  };

  return (
    <div className="p-4">
      <h2>Daftar Order</h2>

      {/* Filter Tanggal */}
      <div className="row mb-3">
        <div className="col-md-3">
          <label className="form-label">Tanggal Awal</label>
          <input
            type="date"
            className="form-control"
            value={startDate}
            onChange={(e) => setStartDate(e.target.value)}
          />
        </div>
        <div className="col-md-3">
          <label className="form-label">Tanggal Akhir</label>
          <input
            type="date"
            className="form-control"
            value={endDate}
            onChange={(e) => setEndDate(e.target.value)}
          />
        </div>
        <div className="col-md-3 d-flex align-items-end">
          <button className="btn btn-primary me-2" onClick={handleSearch}>
            Cari
          </button>
          <button className="btn btn-secondary" onClick={handleReset}>
            Reset
          </button>
        </div>
      </div>

      {pesan && <div className="alert alert-success">{pesan}</div>}

      <table className="table table-bordered table-striped">
        <thead className="table-dark">
          <tr>
            <th>No</th>
            <th>Faktur</th>
            <th>Pelanggan</th>
            <th>Tanggal Order</th>
            <th>Total</th>
            <th>Bayar</th>
            <th>Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          {currentItems.length > 0 ? (
            currentItems.map((item, index) => (
              <tr key={item.idorder}>
                <td>{indexOfFirstItem + index + 1}</td>
                <td>{item.idorder}</td>
                <td>{item.pelanggan}</td>
                <td>{new Date(item.tglorder).toLocaleDateString()}</td>
                <td>Rp {item.total?.toLocaleString()}</td>
                <td>Rp {item.bayar?.toLocaleString()}</td>
                <td>Rp {item.kembali?.toLocaleString()}</td>
                <td>
                  <span
                    className={`badge ${
                      item.status === 1 ? "bg-success" : "bg-warning"
                    }`}
                    style={{ cursor: "pointer" }}
                    onClick={() => item.status !== 1 && openPelunasanModal(item)}
                  >
                    {item.status === 1 ? "Lunas" : "Belum Lunas"}
                  </span>
                </td>
                <td>
                  <button
                    onClick={() => handleDelete(item.idorder)}
                    className="btn btn-danger btn-sm"
                  >
                    Hapus
                  </button>
                </td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan="8" className="text-center">
                {orders.length === 0 ? "Memuat data..." : "Tidak ada data ditemukan"}
              </td>
            </tr>
          )}
        </tbody>
      </table>

      {dataToDisplay.length > 0 && (
        <nav className="mt-3">
          <ul className="pagination justify-content-center">
            <li className={`page-item ${currentPage === 1 ? "disabled" : ""}`}>
              <button
                className="page-link"
                onClick={() => handlePageChange(currentPage - 1)}
              >
                Previous
              </button>
            </li>
            {[...Array(totalPages)].map((_, index) => (
              <li
                key={index}
                className={`page-item ${
                  currentPage === index + 1 ? "active" : ""
                }`}
              >
                <button
                  className="page-link"
                  onClick={() => handlePageChange(index + 1)}
                >
                  {index + 1}
                </button>
              </li>
            ))}
            <li className={`page-item ${currentPage === totalPages ? "disabled" : ""}`}>
              <button
                className="page-link"
                onClick={() => handlePageChange(currentPage + 1)}
              >
                Next
              </button>
            </li>
          </ul>
        </nav>
      )}

      {/* Modal Pelunasan */}
      <Modal show={showModal} onHide={handleCloseModal} centered>
        <Modal.Header closeButton>
          <Modal.Title>Form Pelunasan</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          {selectedOrder && (
            <>
              <p><strong>Pelanggan:</strong> {selectedOrder.pelanggan}</p>
              <p><strong>Total:</strong> Rp {selectedOrder.total?.toLocaleString()}</p>
              <div className="mb-3">
                <label htmlFor="bayar" className="form-label">Bayar</label>
                <input
                  type="number"
                  id="bayar"
                  className="form-control"
                  value={bayar}
                  onChange={(e) => setBayar(e.target.value)}
                />
              </div>
            </>
          )}
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={handleCloseModal}>
            Batal
          </Button>
          <Button variant="primary" onClick={handleSimpanPelunasan}>
            Simpan Pelunasan
          </Button>
        </Modal.Footer>
      </Modal>
    </div>
  );
};

export default Order;
