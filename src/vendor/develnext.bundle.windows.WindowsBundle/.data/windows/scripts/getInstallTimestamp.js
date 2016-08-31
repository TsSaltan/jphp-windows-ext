with (new ActiveXObject('WScript.Shell')) {
  var raw = RegRead('HKLM\\SOFTWARE\\Microsoft\\Windows NT\\CurrentVersion\\InstallDate');
  with (new Date(1970, 0, 1)) {
    WScript.Echo(getSeconds() + raw);
  }
}