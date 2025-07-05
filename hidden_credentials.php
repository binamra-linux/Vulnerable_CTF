<?php
// Hidden administrative credentials
// This file should not be accessible via normal navigation
// But can be accessed via RFI after getting web shell
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administrative Access - CONFIDENTIAL</title>
    <style>
        body { font-family: monospace; background: #000; color: #0f0; padding: 20px; }
        .warning { color: #f00; font-weight: bold; }
        .creds { background: #111; padding: 15px; border: 1px solid #333; margin: 10px 0; }
    </style>
</head>
<body>
    <h1 class="warning">⚠️ RESTRICTED ACCESS - CONFIDENTIAL ⚠️</h1>
    <p>This page contains sensitive system credentials and configuration.</p>
    
    <h2>🔑 SSH Access Credentials</h2>
    <div class="creds">
        <strong>Username:</strong> ctfuser<br>
        <strong>Password:</strong> SecretPassword123!<br>
        <strong>Host:</strong> localhost<br>
        <strong>Port:</strong> 22<br>
        <strong>Access Level:</strong> Standard User
    </div>
    
    <h2>📁 Tmux Session Setup</h2>
    <div class="creds">
        <strong>Session File:</strong> /home/ctfuser/.tmux_session_restore<br>
        <strong>Purpose:</strong> Automated session restoration<br>
        <strong>Contains:</strong> Initial user access flag
    </div>
    
    <h2>🎯 CTF Flags</h2>
    <div class="creds">
        <strong>Web Shell Access:</strong> CTF{rfi_web_shell_achieved}<br>
        <strong>Hidden File Found:</strong> CTF{hidden_credentials_discovered}<br>
    </div>
    
    <h2>📝 Additional Notes</h2>
    <ul>
        <li>SSH access provides shell access to the system</li>
        <li>User has limited privileges but can access user files</li>
        <li>Check /home/ctfuser/.tmux_session_restore for session setup</li>
        <li>Tmux session contains initial access flag</li>
        <li>Look for privilege escalation opportunities</li>
    </ul>
    
    <p style="color: #f00; font-size: 12px;">
        ⚠️ WARNING: Unauthorized access is prohibited. This system is monitored.
    </p>
</body>
</html>
