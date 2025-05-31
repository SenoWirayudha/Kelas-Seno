import React from 'react';
import { useParams } from 'react-router-dom';
import Kategori from './kategori'; // Import component Kategori

const ISI = {
    KATEGORI: () => {
        return <Kategori />;
    },
    
    MENU: () => {
        const { idmenu } = useParams();
        return <h2>Menu {idmenu}</h2>;
    },
    
    PELANGGAN: () => {
        const { idpelanggan } = useParams();
        return <h2>Pelanggan {idpelanggan}</h2>;
    },
    
    ORDER: () => {
        const { idorder } = useParams();
        return <h2>Order {idorder}</h2>;
    },
    
    ORDER_DETAIL: () => {
        const { idorderdetail } = useParams();
        return <h2>Order Detail {idorderdetail}</h2>;
    },
    
    ADMIN: () => {
        const { idadmin } = useParams();
        return <h2>Admin {idadmin}</h2>;
    }
};

export default ISI;