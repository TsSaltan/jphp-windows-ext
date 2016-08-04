var WshShell = new ActiveXObject("WScript.Shell"),
	objFSO = new ActiveXObject("Scripting.FileSystemObject"),
	Startup = WshShell.SpecialFolders("Startup"),
	Link = WshShell.CreateShortcut(Startup + "\\$basename.lnk");
			
with(Link){
	// Описание
   // Description = "$descript";
	// адрес к запускаемому ресурсу
	TargetPath = "$fullpath";
	// описание рабочего_каталога для исполняемого ресурса
	WorkingDirectory = "$dir";
	Save();
}		