from nltk.tag import CRFTagger
ct = CRFTagger()
ct.set_model_file('all_indo_man_tag_corpus_model.crf.tagger')
hasil = ct.tag_sents([['RANCANG', 'BANGUN', 'SISTEM', 'INFORMASI', 'MANAJEMEN']])
print(hasil)
