import { Route, Routes } from 'react-router-dom';
import Kategori from './kategori'; // Import langsung component Kategori
import content from './content';   // Import content untuk halaman lain
import Menu from './menu';
import Pelanggan from './pelanggan'; // pastikan path-nya sesuai
import Order from './order'; // Import component Order
import Detail from './detail'; // Import component Detail
import User from './user'; // Import component User


const Main = () => {
    return (
        <div className="main-content">
            <Routes>
                {/* Route untuk halaman admin default */}
                <Route path="/" element={<div>Admin Dashboard</div>} />
                
                <Route path="kategori" element={<Kategori />} />

                <Route path="menu" element={<Menu />} />

                <Route path="pelanggan" element={<Pelanggan />} />

                <Route path="order" element={<Order />} />

                <Route path="detail" element={<Detail />} />

                <Route path="admin" element={<User />} />
                
                {/* Routes lain dengan parameter */}
                <Route path="menu/:idmenu" element={<content.MENU />} />
                <Route path="pelanggan/:idpelanggan" element={<content.PELANGGAN />} />
                <Route path="order/:idorder" element={<content.ORDER />} />
                <Route path="detail/:iddetail" element={<content.DETAIL />} />
                <Route path="admin/:idadmin" element={<content.ADMIN />} />
            </Routes>
        </div>
    );
};

export default Main;