import React from 'react';
import { Link } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import { 
  ClipboardCheck, 
  LayoutDashboard, 
  LogIn, 
  UserPlus, 
  FolderKanban, 
  CheckSquare, 
  TrendingUp,
  ArrowRight
} from 'lucide-react';

const Welcome = () => {
  const { isAuthenticated } = useAuth();

  return (
    <div className="welcome-page">
      <nav className="welcome-nav">
        <div className="welcome-logo">
          <ClipboardCheck size={28} color="#0d6efd" />
          <span>TaskApp</span>
        </div>
        <div className="welcome-nav-links">
          {isAuthenticated ? (
            <Link to="/dashboard" className="btn btn-primary">
              <LayoutDashboard size={16} />
              Dashboard
            </Link>
          ) : (
            <>
              <Link to="/login" className="btn btn-ghost">
                <LogIn size={16} />
                Sign In
              </Link>
              <Link to="/register" className="btn btn-primary">
                <UserPlus size={16} />
                Get Started
              </Link>
            </>
          )}
        </div>
      </nav>

      <section className="welcome-hero">
        <h1>Manage Your Tasks<br />with <span>Confidence</span></h1>
        <p>Organize projects, track progress, and accomplish your goals with a beautiful and intuitive task management platform.</p>
        <Link 
          to={isAuthenticated ? "/dashboard" : "/register"} 
          className="btn btn-primary" 
          style={{ padding: '14px 36px', fontSize: '1rem', display: 'inline-flex', alignItems: 'center', gap: '8px' }}
        >
          {isAuthenticated ? 'Go to Dashboard' : 'Start Free'}
          <ArrowRight size={18} />
        </Link>
      </section>

      <section className="welcome-features">
        <div className="feature-card">
          <div className="feature-icon">
            <FolderKanban size={32} color="#0d6efd" />
          </div>
          <h3>Project Management</h3>
          <p>Create and organize multiple projects with detailed descriptions and status tracking.</p>
        </div>
        <div className="feature-card">
          <div className="feature-icon">
            <CheckSquare size={32} color="#16a34a" />
          </div>
          <h3>Task Tracking</h3>
          <p>Break projects into tasks, toggle completion, and track your progress in real-time.</p>
        </div>
        <div className="feature-card">
          <div className="feature-icon">
            <TrendingUp size={32} color="#f59e0b" />
          </div>
          <h3>Dashboard Analytics</h3>
          <p>Get instant insights into your productivity with completion rates and statistics.</p>
        </div>
      </section>
    </div>
  );
};

export default Welcome;