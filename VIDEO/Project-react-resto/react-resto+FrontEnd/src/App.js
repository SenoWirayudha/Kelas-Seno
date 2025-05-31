import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
// import 'bootstrap-icons/font/bootstrap-icons.css';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Front from './front/front';
import Back from './back/back';
import Login from './back/login';
import RequireAuth from './RequireAuth';

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/*" element={<Front />} />
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
    </Router>
  );
}

export default App;
