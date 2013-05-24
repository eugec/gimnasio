#
# Hay que tener cuidado de los casos donde la palabra deseada esta
# contenida dentro de otra por ejemplo rol en Controller
#
#
# Forma de uso:
# gawk -f replaceAllInFiles.awk -v changesFile=changes.txt < files.txt
#
#
#

BEGIN {
	storeChanges()
	m = 0
}

#LOOP
{
	split($0, var, "\t")
	files_in[m] = var[1]
	files_out[m] = var[2]
	m++
}

END {
	totalFiles = m
	for(j=0;j<totalFiles;j++){ # recorre los archivos
		for(k=0;;k++){
			if (!getline v < files_in[j])
				break
			fileLines[k] = v
			print replaceAll(fileLines[k]) > files_out[j]
		}
	}
}

function storeChanges() {
	for(i=0;;i++) {
		if (! getline change < changesFile)
			break
		split(change, var, "\t")
		changes_in[i] = var[1]
		changes_out[i] = var[2]
	}
	totalChanges = i
}

function replaceAll(input) {
	output = input
	for (i=0;i<totalChanges;i++){
		output = gensub(changes_in[i], changes_out[i], "g", output)
		#print changes_in[i], changes_out[i]
		#print output
	}
	return output
}
