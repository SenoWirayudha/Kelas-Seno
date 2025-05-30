import { Link } from 'react-router-dom';

const URL = {
    kategori: "/admin/kategori",
    menu: "/admin/menu",
    pelanggan: "/admin/pelanggan",
    order: "/admin/order",
    orderDetail: "/admin/detail",
    admin: "/admin/admin"
};

const Side = () => {
    const userLevel = localStorage.getItem('level');
    return (
        <div className="side">
            <div className="list-group">
                <div className="list-group-item list-group-item-primary">
                    <h3>Menu Aplikasi</h3>
                </div>

                {/* Admin bisa akses semua */}
                {(userLevel === 'admin' || userLevel === 'kasir') && (
                    <>
                        <Link to={URL.order} className="list-group-item list-group-item-action" title="Order">Order</Link>
                        <Link to={URL.orderDetail} className="list-group-item list-group-item-action" title="Order Detail">Order Detail</Link>
                    </>
                )}

                {/* Koki hanya bisa akses orderDetail */}
                {userLevel === 'koki' && (
                    <Link to={URL.orderDetail} className="list-group-item list-group-item-action" title="Order Detail">Order Detail</Link>
                )}

                {/* Admin akses semua menu */}
                {userLevel === 'admin' && (
                    <>
                        <Link to={URL.kategori} className="list-group-item list-group-item-action" title="Kategori">Kategori</Link>
                        <Link to={URL.menu} className="list-group-item list-group-item-action" title="Menu">Menu</Link>
                        <Link to={URL.pelanggan} className="list-group-item list-group-item-action" title="Pelanggan">Pelanggan</Link>
                        <Link to={URL.admin} className="list-group-item list-group-item-action" title="Admin">User Admin</Link>
                    </>
                )}
            </div>
        </div>
    );
};

export default Side;
