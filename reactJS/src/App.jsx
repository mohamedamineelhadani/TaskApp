import React from 'react'

const App = () => {
  
  return (
    <></>
  )
}

export default App



import React from 'react'
import { Route , Routes , Navigate } from 'react-router-dom'
import { useAuth } from './context/AuthContext'
import ProtectedRoute from './components/ProtectedRoute'
import Login from './auth/Login'
import DashboardLayout from './layout/DashboardLayout'
import Welcome from './pages/welcome/Welcome'

function App() {
  const { isAuthenticated } = useAuth();
  return (
    <Routes>
      <Route
        path="/login"
        element={isAuthenticated ? <Navigate to="/dashboard" replace /> : <Login />}
      />

      <Route element={
        <ProtectedRoute>
          <DashboardLayout />
        </ProtectedRoute>
      }>

      <Route path="/dashboard" element={<h1>mohamed amine</h1>} />
      </Route>

      <Route path="/" element={<Welcome />} />
      <Route path="*" element={<Navigate to="/dashboard" replace />} />
    </Routes>
  )
}

export default App
