import React, { useState } from 'react';
import { useAuth } from '../context/AuthContext';
import { profileApi } from '../service/resourceApi';

const Profile = () => {
  const { user, logout } = useAuth();
  const [profileForm, setProfileForm] = useState({ name: user?.name || '', email: user?.email || '' });
  const [passwordForm, setPasswordForm] = useState({ current_password: '', password: '', password_confirmation: '' });
  const [deletePassword, setDeletePassword] = useState('');
  const [msg, setMsg] = useState('');
  const [error, setError] = useState('');
  const [saving, setSaving] = useState(false);

  const showMsg = (text) => { setMsg(text); setError(''); setTimeout(() => setMsg(''), 3000); };
  const showErr = (text) => { setError(text); setMsg(''); };

  const updateProfile = async (e) => {
    e.preventDefault(); setSaving(true); setError('');
    try {
      await profileApi.update(profileForm);
      showMsg('Profile updated!');
    } catch (err) { showErr(err.response?.data?.message || 'Update failed'); }
    finally { setSaving(false); }
  };

  const updatePassword = async (e) => {
    e.preventDefault(); setSaving(true); setError('');
    try {
      await profileApi.updatePassword(passwordForm);
      setPasswordForm({ current_password: '', password: '', password_confirmation: '' });
      showMsg('Password updated!');
    } catch (err) { showErr(err.response?.data?.message || 'Password update failed'); }
    finally { setSaving(false); }
  };

  const deleteAccount = async (e) => {
    e.preventDefault();
    if (!confirm('Are you sure? This action cannot be undone.')) return;
    try {
      await profileApi.deleteAccount(deletePassword);
      logout();
    } catch (err) { showErr(err.response?.data?.message || 'Delete failed'); }
  };

  return (
    <div>
      <div className="page-header">
        <h1 className="page-title">Profile</h1>
        <p className="page-subtitle">Manage your account settings</p>
      </div>

      {msg && <div className="auth-success" style={{ marginBottom: '16px', background: 'var(--success-light)', color: '#166534', border: '1px solid #bbf7d0' }}>{msg}</div>}
      {error && <div className="auth-error" style={{ marginBottom: '16px', background: 'var(--danger-light)', color: '#991b1b', border: '1px solid #fecaca' }}>{error}</div>}

      <div className="profile-grid">
        <section className="profile-section">
          <h3>Profile Information</h3>
          <form onSubmit={updateProfile}>
            <div className="form-group" style={{ marginBottom: '16px' }}>
              <label style={{ display: 'block', marginBottom: '6px', fontSize: '.85rem', fontWeight: 500 }}>Name</label>
              <input value={profileForm.name} onChange={e => setProfileForm({ ...profileForm, name: e.target.value })} required
                style={{ width: '100%', padding: '10px 14px', border: '1px solid var(--border-color)', borderRadius: 'var(--border-radius)', outline: 'none' }} />
            </div>
            <div className="form-group" style={{ marginBottom: '16px' }}>
              <label style={{ display: 'block', marginBottom: '6px', fontSize: '.85rem', fontWeight: 500 }}>Email</label>
              <input type="email" value={profileForm.email} onChange={e => setProfileForm({ ...profileForm, email: e.target.value })} required
                style={{ width: '100%', padding: '10px 14px', border: '1px solid var(--border-color)', borderRadius: 'var(--border-radius)', outline: 'none' }} />
            </div>
            <button className="btn btn-primary" disabled={saving}>{saving ? 'Saving...' : 'Save Changes'}</button>
          </form>
        </section>

        <section className="profile-section">
          <h3>Update Password</h3>
          <form onSubmit={updatePassword}>
            <div className="form-group" style={{ marginBottom: '16px' }}>
              <label style={{ display: 'block', marginBottom: '6px', fontSize: '.85rem', fontWeight: 500 }}>Current Password</label>
              <input type="password" value={passwordForm.current_password} onChange={e => setPasswordForm({ ...passwordForm, current_password: e.target.value })} required
                style={{ width: '100%', padding: '10px 14px', border: '1px solid var(--border-color)', borderRadius: 'var(--border-radius)', outline: 'none' }} />
            </div>
            <div className="form-group" style={{ marginBottom: '16px' }}>
              <label style={{ display: 'block', marginBottom: '6px', fontSize: '.85rem', fontWeight: 500 }}>New Password</label>
              <input type="password" value={passwordForm.password} onChange={e => setPasswordForm({ ...passwordForm, password: e.target.value })} required
                style={{ width: '100%', padding: '10px 14px', border: '1px solid var(--border-color)', borderRadius: 'var(--border-radius)', outline: 'none' }} />
            </div>
            <div className="form-group" style={{ marginBottom: '16px' }}>
              <label style={{ display: 'block', marginBottom: '6px', fontSize: '.85rem', fontWeight: 500 }}>Confirm New Password</label>
              <input type="password" value={passwordForm.password_confirmation} onChange={e => setPasswordForm({ ...passwordForm, password_confirmation: e.target.value })} required
                style={{ width: '100%', padding: '10px 14px', border: '1px solid var(--border-color)', borderRadius: 'var(--border-radius)', outline: 'none' }} />
            </div>
            <button className="btn btn-primary" disabled={saving}>Update Password</button>
          </form>
        </section>

        <section className="profile-section" style={{ borderColor: 'var(--danger)' }}>
          <h3 style={{ color: 'var(--danger)' }}>Delete Account</h3>
          <p style={{ fontSize: '.85rem', color: 'var(--text-secondary)', marginBottom: '16px' }}>
            Once your account is deleted, all data will be permanently removed.
          </p>
          <form onSubmit={deleteAccount}>
            <div className="form-group" style={{ marginBottom: '16px' }}>
              <label style={{ display: 'block', marginBottom: '6px', fontSize: '.85rem', fontWeight: 500 }}>Confirm your password</label>
              <input type="password" value={deletePassword} onChange={e => setDeletePassword(e.target.value)} required
                style={{ width: '100%', padding: '10px 14px', border: '1px solid var(--border-color)', borderRadius: 'var(--border-radius)', outline: 'none' }} />
            </div>
            <button className="btn btn-danger">Delete Account</button>
          </form>
        </section>
      </div>
    </div>
  );
};

export default Profile;
