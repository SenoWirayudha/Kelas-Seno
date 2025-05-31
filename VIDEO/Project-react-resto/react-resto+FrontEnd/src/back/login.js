import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from '../axios/link';

const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [pesan, setPesan] = useState('');
  
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
  
    console.log('🚀 Attempting login with:', { email, password });
  
    try {
      const response = await axios.post('/login', { email, password });
      const token = response.data.token;
      const level = response.data.data?.level;
      const userEmail = response.data.data?.email;

      if (token && level) {
        localStorage.setItem('token', token);
        localStorage.setItem('level', level);
        localStorage.setItem('email', userEmail);
        navigate('/admin');
      } else {
        setPesan('Email atau password salah');
      }
  
      setEmail('');
      setPassword('');
    } catch (error) {
      console.error('Login gagal:', error);
      setPesan('Email atau password salah');
    }
  };

  return (
    <div className="container mt-5">
      <div className="row justify-content-center">
        <div className="col-md-6">
          <div className="card">
            <div className="card-body">
              <h2 className="card-title text-center mb-4">Login</h2>

              {pesan && (
                <div className="alert alert-danger">
                  {pesan}
                </div>
              )}

              <form onSubmit={handleSubmit}>
                <div className="mb-3">
                  <label htmlFor="email" className="form-label">Email</label>
                  <input
                    type="email"
                    className="form-control"
                    id="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                  />
                </div>

                <div className="mb-3">
                  <label htmlFor="password" className="form-label">Password</label>
                  <input
                    type="password"
                    className="form-control"
                    id="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                  />
                </div>

                <button type="submit" className="btn btn-primary w-100">
                  Login
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Login;