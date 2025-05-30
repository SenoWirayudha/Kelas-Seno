import Nav from './nav';
import Side from './side';
import Main from './main';
import Footer from './footer';

function Front() {
    return (
        <div>
            <Nav />
            <div style={{ display: 'flex' }}>
                <Side />
                <Main />
            </div>
            <Footer />
        </div>
    );
}

export default Front;