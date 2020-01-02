PROG=0
ADV=$1
if [ "$ADV" = "" ]; then
  ADV=`mktemp`
fi
echo $PROG > $ADV
cd `dirname $0`
chmod a+x *.sh
NBSTEPS=`ls */install.sh | wc -l`
STEP=$((100/$NBSTEPS))
for i in */install.sh; do
  echo '******************************'
  echo -- installing $i --
  PROG=$(($PROG+$STEP))
  chmod a+x $i
  eval $i
  echo $PROG > $ADV
done
rm $ADV
