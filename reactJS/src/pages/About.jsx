import React from 'react';
import { 
  FolderKanban, 
  CheckCircle, 
  BarChart3, 
  UserCircle, 
  Mail, 
  Shield,
  Server,
  Monitor,
  Code
} from 'lucide-react';

const About = () => {
  return (
    <div>
      <div className="page-header">
        <h1 className="page-title">About TaskApp</h1>
        <p className="page-subtitle">Learn more about this platform</p>
      </div>

      <div className="about-section">
        <div className="card" style={{ marginBottom: '24px' }}>
          <div className="card-body">
            <h2 style={{ fontSize: '1.2rem', fontWeight: 600, marginBottom: '12px' }}>What is TaskApp?</h2>
            <p style={{ color: 'var(--text-secondary)', lineHeight: 1.8 }}>
              TaskApp is a modern project and task management platform built to help you stay organized and productive.
              Create projects, break them into manageable tasks, and track your progress with intuitive dashboards.
            </p>
          </div>
        </div>

        <div className="card" style={{ marginBottom: '24px' }}>
          <div className="card-body">
            <h2 style={{ fontSize: '1.2rem', fontWeight: 600, marginBottom: '12px' }}>Features</h2>
            <ul style={{ color: 'var(--text-secondary)', lineHeight: 2, paddingLeft: '20px', listStyle: 'none' }}>
              <li><FolderKanban size={16} style={{ marginRight: '8px', verticalAlign: 'middle', color: '#0d6efd' }} />Create and manage multiple projects</li>
              <li><CheckCircle size={16} style={{ marginRight: '8px', verticalAlign: 'middle', color: '#16a34a' }} />Add tasks to projects and track completion</li>
              <li><BarChart3 size={16} style={{ marginRight: '8px', verticalAlign: 'middle', color: '#f59e0b' }} />Dashboard with real-time analytics</li>
              <li><UserCircle size={16} style={{ marginRight: '8px', verticalAlign: 'middle', color: '#7c3aed' }} />Profile management with password updates</li>
              <li><Mail size={16} style={{ marginRight: '8px', verticalAlign: 'middle', color: '#0d6efd' }} />Contact form for support</li>
              <li><Shield size={16} style={{ marginRight: '8px', verticalAlign: 'middle', color: '#16a34a' }} />Secure authentication with Sanctum tokens</li>
            </ul>
          </div>
        </div>

        <div className="card">
          <div className="card-body">
            <h2 style={{ fontSize: '1.2rem', fontWeight: 600, marginBottom: '12px' }}>Tech Stack</h2>
            <p style={{ color: 'var(--text-secondary)', lineHeight: 1.8 }}>
              <strong><Server size={14} style={{ marginRight: '4px', verticalAlign: 'middle' }} />Backend:</strong> Laravel 10 with Sanctum API authentication<br />
              <strong><Monitor size={14} style={{ marginRight: '4px', verticalAlign: 'middle' }} />Frontend:</strong> React 19 with React Router<br />
              <strong><Code size={14} style={{ marginRight: '4px', verticalAlign: 'middle' }} />API:</strong> RESTful JSON API with token-based auth
            </p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default About;