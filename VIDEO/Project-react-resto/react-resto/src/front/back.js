import Nav from './nav';
import Side from './side';
import Main from './main';
import Footer from './footer';

const Front = () => {
    return (
        <div className="front">
            <Nav />
            <div className="content">
                <Side />
                <Main />
            </div>
            <Footer />
        </div>
    );
};

export default Front;