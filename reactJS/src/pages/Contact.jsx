import React, { useState } from 'react';
import { contactApi } from '../service/resourceApi';

const Contact = () => {
  const [form, setForm] = useState({ subject: '', message: '' });
  const [msg, setMsg] = useState('');
  const [error, setError] = useState('');
  const [sending, setSending] = useState(false);

  const handleSubmit = async (e) => {
    e.preventDefault(); setSending(true); setError(''); setMsg('');
    try {
      const res = await contactApi.send(form);
      setMsg(res.message || 'Message sent successfully!');
      setForm({ subject: '', message: '' });
    } catch (err) {
      setError(err.response?.data?.message || 'Failed to send message');
    } finally { setSending(false); }
  };

  return (
    <div>
      <div className="page-header">
        <h1 className="page-title">Contact Us</h1>
        <p className="page-subtitle">Have a question or feedback? We'd love to hear from you.</p>
      </div>

      <div className="card contact-card">
        <div className="card-body">
          {msg && <div className="auth-success" style={{ marginBottom: '16px', background: 'var(--success-light)', color: '#166534', border: '1px solid #bbf7d0' }}>{msg}</div>}
          {error && <div className="auth-error" style={{ marginBottom: '16px', background: 'var(--danger-light)', color: '#991b1b', border: '1px solid #fecaca' }}>{error}</div>}

          <form onSubmit={handleSubmit}>
            <div className="form-group" style={{ marginBottom: '16px' }}>
              <label style={{ display: 'block', marginBottom: '6px', fontSize: '.85rem', fontWeight: 500 }}>Subject</label>
              <input value={form.subject} onChange={e => setForm({ ...form, subject: e.target.value })} placeholder="What's this about?"
                style={{ width: '100%', padding: '10px 14px', border: '1px solid var(--border-color)', borderRadius: 'var(--border-radius)', outline: 'none' }} />
            </div>
            <div className="form-group" style={{ marginBottom: '16px' }}>
              <label style={{ display: 'block', marginBottom: '6px', fontSize: '.85rem', fontWeight: 500 }}>Message *</label>
              <textarea value={form.message} onChange={e => setForm({ ...form, message: e.target.value })} placeholder="Your message (min 10 characters)" rows={5} required
                style={{ width: '100%', padding: '10px 14px', border: '1px solid var(--border-color)', borderRadius: 'var(--border-radius)', outline: 'none', resize: 'vertical' }} />
            </div>
            <button className="btn btn-primary" disabled={sending}>{sending ? 'Sending...' : 'Send Message'}</button>
          </form>
        </div>
      </div>
    </div>
  );
};

export default Contact;
