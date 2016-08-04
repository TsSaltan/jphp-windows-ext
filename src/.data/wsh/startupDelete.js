var WshShell = new ActiveXObject("WScript.Shell"),
	objFSO = new ActiveXObject("Scripting.FileSystemObject"),
	Startup = WshShell.SpecialFolders("Startup");
			
objFSO.DeleteFile(Startup + "\\$basename.lnk");