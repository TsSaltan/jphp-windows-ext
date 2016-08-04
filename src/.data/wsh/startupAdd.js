var WshShell = new ActiveXObject("WScript.Shell"),
	objFSO = new ActiveXObject("Scripting.FileSystemObject"),
	Startup = WshShell.SpecialFolders("Startup"),
	Link = WshShell.CreateShortcut(Startup + "\\$basename.lnk");
			
with(Link){
	TargetPath = "$fullpath";
	WorkingDirectory = "$dir";
	Save();
}		