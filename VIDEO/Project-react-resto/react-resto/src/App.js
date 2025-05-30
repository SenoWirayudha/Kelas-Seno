import logo from './logo.svg';
import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Front from './front/front';
import Back from './back/back';
import Login from './back/login';
import RequireAuth from './RequireAuth'; // tambahkan ini

function App() {
  return (
    <Router>
      <div className="App">
        <Routes>
          <Route path="/" element={<Front />} />
          <Route path="/login" element={<Login />} />
          <Route 
            path="/admin/*" 
            element={
              <RequireAuth>
                <Back />
              </RequireAuth>
            } 
          />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
