// front/front.js
import React from 'react';
import Side from './side';
import Main from './main';
import Nav from './nav';
import Footer from './footer';
// import Cart from './cart';
// import Menu from './menu';


const Front = () => {
  return (
    <div>
      <Nav />
      <div className="d-flex">
        <Side />
        <Main />
      </div>
      <Footer />
    </div>
  );
};

export default Front;
