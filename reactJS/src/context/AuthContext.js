import { createContext, useContext, useState, useEffect } from "react";
import authApi from "../services/authApi" ;

const AuthContext = createContext(null);

export const AuthProvider = ({ children }) => {
  const [user,    setUser]    = useState(JSON.parse(localStorage.getItem("user")) ?? null);
  const [token,   setToken]   = useState(localStorage.getItem("token") ?? null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const verifyToken = async () => {
      if (!token) return setLoading(false);
      try {
        const { data } = await authApi.me();
        setUser(data.data);
      } catch {
        logout();
      } finally {
        setLoading(false);
      }
    };
    verifyToken();
  }, []);

  const login = async (email, password) => {
    const { data } = await authApi.login({ email, password });
    const { user, access_token } = data.data;
    setToken(access_token);
    setUser(user);
    localStorage.setItem("token", access_token);
    localStorage.setItem("user",  JSON.stringify(user));
  };

  const logout = async () => {
    try { await authApi.logout(); } catch {}
    setToken(null);
    setUser(null);
    localStorage.removeItem("token");
    localStorage.removeItem("user");
  };

  return (
    <AuthContext.Provider value={{
      user,
      token,
      loading,
      login,
      logout,
      isAuthenticated: !!token,
    }}>
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => useContext(AuthContext);

